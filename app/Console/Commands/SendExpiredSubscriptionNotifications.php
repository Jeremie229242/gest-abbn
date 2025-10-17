<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Subscription;
use Illuminate\Support\Facades\Mail;
use App\Mail\SubscriptionExpiredMail; // 📩 À créer (semblable à SubscriptionReminderMail)
use App\Mail\AdminExpiredMail;        // 📩 À créer (semblable à AdminReminderMail)
use Carbon\Carbon;

class SendExpiredSubscriptionNotifications extends Command
{
    protected $signature = 'subscriptions:notify-expired';
    protected $description = 'Envoie des notifications pour les abonnements expirés et met à jour leur statut.';

    public function handle()
    {
        $today = Carbon::today();

        // 🔍 On récupère les abonnements expirés mais encore "actifs"
        $expiredSubs = Subscription::where('expiration_date', '<', $today)
            ->where('status', true)
            ->where('position', false)
            ->with(['user', 'emails', 'site'])
            ->get();

        // 📧 Emails des administrateurs définis dans .env
        $adminEmails = array_filter(array_map('trim', explode(',', env('ADMIN_EMAILS', ''))));

        if ($expiredSubs->isEmpty()) {
            $this->info("Aucun abonnement expiré trouvé.");
            return Command::SUCCESS;
        }

        foreach ($expiredSubs as $sub) {
            // 🕒 Marque l’abonnement comme expiré
            $sub->update([
                'status' => false,
               
            ]);

            $siteName = $sub->site ? $sub->site->nom : $sub->site_id;

            // 📨 1️⃣ Envoi aux emails liés à l’abonnement
            foreach ($sub->emails as $email) {
                Mail::to($email->email)
                    ->queue(new SubscriptionExpiredMail($sub));
            }

            // 📨 2️⃣ Envoi à l’utilisateur créateur
            if ($sub->user && $sub->user->email) {
                Mail::to($sub->user->email)
                    ->queue(new AdminExpiredMail($sub));
            }

            // 📨 3️⃣ Envoi aux administrateurs du .env
            foreach ($adminEmails as $adminEmail) {
                Mail::to($adminEmail)
                    ->queue(new AdminExpiredMail($sub));
            }

            // 📝 Log clair dans la console
            $this->info("🔔 Abonnement expiré : {$sub->name} (Site: {$siteName}) " .
                "— mails envoyés à " . $sub->emails->pluck('email')->implode(', ') .
                ($sub->user ? " + user {$sub->user->email}" : '') .
                (!empty($adminEmails) ? " + admins " . implode(', ', $adminEmails) : '')
            );
        }

        return Command::SUCCESS;
    }
}
