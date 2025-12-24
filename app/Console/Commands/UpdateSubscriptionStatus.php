<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\Subscription;
use Carbon\Carbon;

class UpdateSubscriptionStatus extends Command
{
    protected $signature = 'subscriptions:update-status';
    protected $description = 'Met à jour automatiquement le status des abonnements';

    public function handle()
    {
        $today = Carbon::today();

        // 🔴 Expirés → status = false
        Subscription::whereDate('expiration_date', '<=', $today)
            ->where('status', true)
            ->update([
                'status' => false,
            ]);

        // 🟢 Actifs → status = true (sécurité)
        // Subscription::whereDate('expiration_date', '>=', $today)
        //     ->where('status', false)
        //     ->where('qnadb', false)
        //     ->update([
        //         'status' => true,
        //     ]);

        $this->info('✅ Statuts des abonnements mis à jour');
        return Command::SUCCESS;
    }
}

