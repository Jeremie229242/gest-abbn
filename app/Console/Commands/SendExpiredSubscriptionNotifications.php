<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Subscription;
use Illuminate\Support\Facades\Mail;
use App\Mail\SubscriptionExpiredMail;
use App\Mail\AdminExpiredMail;
use Carbon\Carbon;

class SendExpiredSubscriptionNotifications extends Command
{
    protected $signature = 'subscriptions:notify-expired';
    protected $description = 'Envoie des notifications pour les abonnements expirés et met à jour leur statut.';

    public function handle()
    {
        $today = Carbon::today();

        // 🔍 Récupérer les abonnements expirés mais encore "actifs"
        $expiredSubs = Subscription::where('expiration_date', '<=', $today)
            ->where('status', true)
            ->where('position', false)
            ->with(['client.emails', 'client.user', 'site'])
            ->get();

        // 📧 Emails administrateurs définis dans .env
        $adminEmails = array_filter(array_map('trim', explode(',', env('ADMIN_EMAILS', ''))));

        if ($expiredSubs->isEmpty()) {
            $this->info("Aucun abonnement expiré trouvé aujourd'hui ✅");
            return Command::SUCCESS;
        }

        foreach ($expiredSubs as $sub) {
            $sub->update(['status' => false]);

            $siteName = $sub->site ? $sub->site->nom : 'N/A';
            $emailsSent = [];

            // 📨 1️⃣ Envoi aux emails du client
            if ($sub->client && $sub->client->emails) {
                foreach ($sub->client->emails as $email) {
                    Mail::to($email->email)->queue(new SubscriptionExpiredMail($sub));
                    $emailsSent[] = $email->email;
                }
            }

            // 📨 2️⃣ Envoi à l’utilisateur ayant créé le client
            if ($sub->client && $sub->client->user && $sub->client->user->email) {
                Mail::to($sub->client->user->email)->queue(new AdminExpiredMail($sub));
                $emailsSent[] = $sub->client->user->email;
            }

            // 📨 3️⃣ Envoi aux administrateurs du .env
            foreach ($adminEmails as $adminEmail) {
                Mail::to($adminEmail)->queue(new AdminExpiredMail($sub));
                $emailsSent[] = $adminEmail;
            }

            // 📝 Log clair dans la console
            $this->warn("❌ Abonnement expiré : {$sub->name} (Site: {$siteName})");
            $this->info("📤 Emails envoyés à : " . implode(', ', $emailsSent));
        }

        return Command::SUCCESS;
    }
}
