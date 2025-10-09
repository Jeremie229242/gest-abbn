<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Subscription;
use App\Mail\SubscriptionReminderMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class SendSubscriptionReminders extends Command
{
    protected $signature = 'subscriptions:send-reminders';
    protected $description = 'Envoie des rappels par e-mail pour les abonnements arrivant à expiration';

    public function handle()
    {
        $today = Carbon::today();

        $subscriptions = Subscription::all();

        foreach ($subscriptions as $sub) {
            $remindDate = Carbon::parse($sub->expiration_date)->subDays($sub->remind_before_days);

            if ($today->equalTo($remindDate)) {
                 foreach ($sub->emails as $email) {
                     Mail::to($email->email)->send(new SubscriptionReminderMail($sub));
                 }

               // foreach ($sub->emails as $email) {
                //    Mail::to($email->email)->send(new SubscriptionReminderMail($sub));

                    // Pause d’1 seconde pour éviter la limite
                //    sleep(1);
               // }


                $this->info("Rappels envoyés pour {$sub->name} à " . $sub->emails->pluck('email')->implode(', '));
            }
        }




        return Command::SUCCESS;
    }
}
