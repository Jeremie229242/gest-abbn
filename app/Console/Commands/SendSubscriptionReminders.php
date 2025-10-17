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

        // Charge les abonnements avec leurs relations
        $subscriptions = Subscription::with(['emails', 'user', 'site'])->get();

        // Récupère les emails d’admins depuis le .env
        $adminEmails = array_filter(array_map('trim', explode(',', env('ADMIN_EMAILS', ''))));

        foreach ($subscriptions as $sub) {

            // Calcul de la date de rappel
            $remindDate = Carbon::parse($sub->expiration_date)->subDays($sub->remind_before_days);

            if ($today->equalTo($remindDate)) {

                $daysLeft = Carbon::parse($sub->expiration_date)->diffInDays($today);

                // 1️⃣ Envoi aux emails liés à l’abonnement
                foreach ($sub->emails as $email) {
                    Mail::to($email->email)
                        ->queue(new SubscriptionReminderMail($sub));
                }

                // 2️⃣ Envoi à l’utilisateur créateur
                if ($sub->user && $sub->user->email) {
                    Mail::to($sub->user->email)
                        ->queue(new AdminReminderMail($sub, $daysLeft));
                }

                // 3️⃣ Envoi aux administrateurs définis dans .env
                foreach ($adminEmails as $adminEmail) {
                    Mail::to($adminEmail)
                        ->queue(new AdminReminderMail($sub, $daysLeft));
                }

                $siteName = $sub->site ? $sub->site->nom : $sub->site_id;

                $this->info("Rappels envoyés pour {$sub->name} (Site: {$siteName}) " .
                    "à : " . $sub->emails->pluck('email')->implode(', ') .
                    ($sub->user ? " + user {$sub->user->email}" : '') .
                    (!empty($adminEmails) ? " + admins " . implode(', ', $adminEmails) : '')
                );


            }
        }

        return Command::SUCCESS;
    }

}