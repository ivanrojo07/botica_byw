<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ExcelFTP extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'excel:get';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Descarga los archivos desde ftp.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //

        $contenidoCAT = Storage::disk('ftp')->get('/out/CATALOGO.CSV');
        Storage::put('public/CATALOGO.csv', $contenidoCAT);
        $contenidoCAM = Storage::disk('ftp')->get('/out/CAMBIOS.CSV');
        Storage::put('public/CAMBIOS.csv', $contenidoCAM);
        $contenidoOFE = Storage::disk('ftp')->get('/out/OFERTAS.CSV');
        storage::put('public/OFERTAS.csv',$contenidoOFE);
        \Log::info('Archivos descargados a las '.\Carbon\Carbon::now());
    }
}
