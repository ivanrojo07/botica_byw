<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Catalogo;

class FotosProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'excel:fotos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Verifica cuales productos no tienen fotos.';

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
        \Log::info('Verificando fotos de productos '.\Carbon\Carbon::now());

        $catalogos = Catalogo::get();
        $files = \File::allFiles('public/img_marzam');
        // dd(pathinfo($files[0])['filename']);
        foreach ($catalogos as $catalogo) {
            foreach ($files as $file) {
                if(str_pad($catalogo->codigo_marzam,7,'0',STR_PAD_LEFT) == pathinfo($file)['filename']){
                    $catalogo->foto = 1;
                    $catalogo->save();
                }
            }
        }
        \Log::info('Verificando fotos de productos '.\Carbon\Carbon::now().' terminada');
    }
}
