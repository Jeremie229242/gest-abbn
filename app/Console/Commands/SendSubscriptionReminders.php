<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Subscription;
use App\Mail\SubscriptionReminderMail;
use App\Mail\AdminReminderMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;




class SendSubscriptionReminders extends Command
{
    protected $signature = 'subscriptions:send-reminders';
    protected $description = 'Envoie des rappels par e-mail pour les abonnements arrivant à expiration';

    public function handle()
    {
        $today = Carbon::today();

        $subscriptions = Subscription::where('status', true)
            ->with(['client.emails', 'client.user'])
            ->get();

        $adminEmails = array_filter(
            array_map('trim', explode(',', env('ADMIN_EMAILS', '')))
        );

        foreach ($subscriptions as $sub) {

            // 🔒 Sécurité dates
            if (!$sub->expiration_date || !$sub->remind_before_days) {
                continue;
            }

            $expirationDate = Carbon::parse($sub->expiration_date);
            $remindDate = $expirationDate->copy()->subDays($sub->remind_before_days);

            if (
                $today->greaterThanOrEqualTo($remindDate) &&
                $today->lessThanOrEqualTo($expirationDate)
            ) {
                $daysLeft = $today->diffInDays($expirationDate, false);
                $clientName = $sub->client?->rai_soci ?? 'Client inconnu';

                // 1️⃣ Emails du client
                foreach ($sub->client?->emails ?? [] as $email) {
                    Mail::to($email->email)
                        ->send(new SubscriptionReminderMail($sub));
                }

                // 2️⃣ Utilisateur lié au client
                if ($sub->client?->user?->email) {
                    Mail::to($sub->client->user->email)
                        ->send(new AdminReminderMail($sub, $daysLeft));
                }

                // 3️⃣ Admins
                foreach ($adminEmails as $adminEmail) {
                    Mail::to($adminEmail)
                        ->send(new AdminReminderMail($sub, $daysLeft));
                }

                $this->info(
                    "📧 Rappel envoyé | Abonnement #{$sub->id} | Client: {$clientName} | J-{$daysLeft}"
                );
            }
        }

        return Command::SUCCESS;
    }
}

