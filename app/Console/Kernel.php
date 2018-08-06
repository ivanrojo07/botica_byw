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

        //
        'App\Console\Commands\LogDemo',
        'App\Console\Commands\ExcelFTP',
        'App\Console\Commands\CambiosFTP',
        'App\Console\Commands\CatalogoFTP',
        'App\Console\Commands\OfertasFTP',
        'App\Console\Commands\FotosProducts',
        'App\Console\Commands\ReportesSFTP',

    ];



    /**

     * Define the application's command schedule.

     *

     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule

     * @return void

     */

    protected function schedule(Schedule $schedule)

    {

        // $schedule->command('inspire')

        //          ->hourly();
        $schedule->command('excel:get')->timezone('America/Mexico_City')->dailyAt('05:00');
        $schedule->command('excel:upload')->timezone('America/Mexico_City')->dailyAt('06:00');
        $schedule->command('cambios:upload')->timezone('America/Mexico_City')->dailyAt('07:00');
        $schedule->command('log:demo');
        // $schedule->command('excel:get')->hourly();
        // $schedule->command('excel:upload')->hourly();
        // $schedule->command('cambios:upload')->hourly();

    }



    /**

     * Register the Closure based commands for the application.

     *

     * @return void

     */

    protected function commands()

    {

        require base_path('routes/console.php');

    }

}

