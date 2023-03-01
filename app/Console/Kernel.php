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
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('command:cancel-orders')->everyMinute()->withoutOverlapping();
        $schedule->command('send:bot-global-messages')->everyMinute()->withoutOverlapping();
        $schedule->command('ping:api-clients')->everyMinute()->withoutOverlapping();
        $schedule->command('remove:requests-geocoding')->daily()->at('03:00')->withoutOverlapping();
        $schedule->command('backup:clean')->daily()->at('01:00')->withoutOverlapping();
        $schedule->command('backup:run')->daily()->at('02:00')->withoutOverlapping();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
