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
    // protected $commands = [
    //     Commands\DailyEmailForUncompletedTrajets::class,
    // ];

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('backup:weekly')->weekly();
        $schedule->command('check:papier-due-dates')->dailyAt('10:00');

        // $schedule->command('email:uncompleted-trajets')->everyMinute(); // Run the command daily
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
