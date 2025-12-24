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

        // On récupère toutes les subscriptions avec leurs relations
        $subscriptions = Subscription::where('status', true)
            ->with(['client.emails', 'client.user'])
            ->get();

        // Emails des administrateurs depuis le .env
        $adminEmails = array_filter(array_map('trim', explode(',', env('ADMIN_EMAILS', ''))));

        foreach ($subscriptions as $sub) {
           // $remindDate = Carbon::parse($sub->expiration_date)->subDays($sub->remind_before_days);
           $expirationDate = Carbon::parse($sub->expiration_date);
        $remindDate = $expirationDate->copy()
            ->subDays($sub->remind_before_days);

            // Si c’est le jour du rappel
            if (
                $today->greaterThanOrEqualTo($remindDate) &&
                $today->lessThanOrEqualTo($expirationDate)
            ) {
                $daysLeft = Carbon::parse($sub->expiration_date)->diffInDays($today);

                // 1️⃣ Envoi à tous les emails liés au client
                if ($sub->client && $sub->client->emails) {
                    foreach ($sub->client->emails as $email) {
                        Mail::to($email->email)
                            ->queue(new SubscriptionReminderMail($sub));
                    }
                }

                // 2️⃣ Envoi à l’utilisateur lié au client
                if ($sub->client && $sub->client->user && $sub->client->user->email) {
                    Mail::to($sub->client->user->email)
                        ->queue(new AdminReminderMail($sub, $daysLeft));
                }

                // 3️⃣ Envoi aux administrateurs
                foreach ($adminEmails as $adminEmail) {
                    Mail::to($adminEmail)
                        ->queue(new AdminReminderMail($sub, $daysLeft));
                }

                // Console log
                $this->info("📧 Rappels envoyés pour l'abonnement ID {$sub->id} du client {$sub->client->rai_soci}");
            }
        }

        return Command::SUCCESS;
    }
}
