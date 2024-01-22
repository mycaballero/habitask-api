<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * @param Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('app:process-pickings')
            ->weekdays()
            ->timezone('America/Bogota')
            ->between('7:40', '17:20')
            ->everyTenMinutes();

        $schedule->command('app:process-pickings')
            ->saturdays()
            ->timezone('America/Bogota')
            ->between('7:40', '10:00')
            ->everyTenMinutes();
    }

    /**
     * @return void
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');
        require base_path('routes/console.php');
    }
}
