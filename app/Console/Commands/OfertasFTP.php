<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class OfertasFTP extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'excel:ofertas';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Subes las ofertas a la base de datos.';

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
        \Log::info('Iniciando la subida de las ofertas a la base de datos a las '.\Carbon\Carbon::now());
        Excel::filter('chunk')->load(storage_path("/app/public/OFERTAS.csv"),null,null,true,null)->chunk(250,
            function($results){
                foreach ($results as $key => $value) {
                    # code...
                    set_time_limit(0);
                }
            });
    }
}
