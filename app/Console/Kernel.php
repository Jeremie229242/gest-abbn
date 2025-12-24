<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(\Illuminate\Console\Scheduling\Schedule $schedule): void
    {
       // $schedule->command('subscriptions:send-reminders')->dailyAt('08:00');
       $schedule->command('subscriptions:send-reminders')->everyMinute();
       //$schedule->command('subscriptions:notify-expired')->dailyAt('10:00');
       $schedule->command('subscriptions:notify-expired')->everyMinute();
       $schedule->command('subscriptions:update-status')->dailyAt('00:01');

    }


    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
