<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\ReadExcelCommand::class,
        Commands\MoicSMSGeneration::class,
        Commands\MoicSmsDispatch::class,
        Commands\MoicTargettedSmsDispatch::class,
        Commands\BeneficiarySmsDispatch::class,
        Commands\AnmSmsDispatch::class,
        Commands\ExportRankingReports::class,
        Commands\MoicRankingsPDF::class,
        Commands\MoicSaveRankingZip::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('custom:command')->everyFiveMinutes();
        //$schedule->command('unopened_weblinks:anm')->daily();

        //****sms scheduler starts**************************
        $schedule->command('moic:sms_create')->everyFiveMinutes();
        // $schedule->command('moic:sms_dispatch')->everyTenMinutes();
        //$schedule->command('moic:targetted_sms')->everyThirtyMinutes();
        //$schedule->command('beneficiary:sms_dispatch')->everyThirtyMinutes();
        // $schedule->command('anm:sms_dispatch')->everyThirtyMinutes();

        //$schedule->command('moic:sms_create')->everyFiveMinutes();
        //$schedule->command('moic:sms_dispatch')->everyTenMinutes();
        //$schedule->command('moic:targetted_sms')->everyThirtyMinutes();
        //$schedule->command('beneficiary:sms_dispatch')->everyThirtyMinutes();
        //$schedule->command('anm:sms_dispatch')->everyThirtyMinutes();

        $schedule->command('nudge:dispatch_sms')->everyFifteenMinutes();

        //****sms scheduler ends*****************************


        //****Rankings schedular starts**********************
        $schedule->command('moic:ranking_report')->everyFiveMinutes();
        $schedule->command('moic:save_pdf')->everyFiveMinutes();
        $schedule->command('moic:save_zip')->hourly();
        //****Rankings schedular ends************************

        $schedule->command('feedback:weblink')->everyFiveMinutes();
        $schedule->command('feedback:complete_sms')->everyFiveMinutes();
        //$schedule->command('feedback:sms_dispatch')->everyFiveMinutes();
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
