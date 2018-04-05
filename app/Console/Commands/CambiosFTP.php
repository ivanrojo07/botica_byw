<?php

namespace App\Console\Commands;

use App\Catalogo;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class CambiosFTP extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cambios:upload';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sube los cambios que se encuentran en cambios.csv a la base de datos.';

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
        \Log::info('Iniciando subida de cambios a la base de datos '.\Carbon\Carbon::now());
        Excel::filter('chunk')->load(storage_path("/app/public/CAMBIOS.csv"),null,null,true,null)->chunk(250, function($results) {
                // dd($results);
                foreach ($results as $key => $value) {
                    # code...
                    // dd($value);
                    // $descripcion = iconv('ASCII//TRANSLIT', 'UTF-8',  $value["descripcion_terapeutica"]);
                    // dd($descripcion);
                    set_time_limit(0); 
                    
                     $catalogo = Catalogo::where("codigo_marzam", $value["codigo_marzam"])->update(
                         // [
                         //     "codigo_marzam"=>$value["codigo_marzam"]
                         // ]
                         // ,
                         [
                             "fecha_actual"=>$value["fecha_actual"],
                             "codigo_marzam"=>$value["codigo_marzam"],
                             "descripcion"=>preg_replace('/\s\s+/', '', $value["descipcion"]),
                             // "descripcion"=>preg_replace('/\s\s+/', '', $value["descipcion"]),
                             "precio_farmacia"=>$value["precio_farmacia"],
                             "precio_publico"=>$value["precio_publico"],
                             "iva"=>$value["iva"],
                             "ieps"=>$value["ieps"],
                             "impuesto_3"=>$value["impuesto_3"],
                             "clasificacion_fiscal"=>$value["clasificacion_fiscal"],
                             "codigo_de_barras"=>$value["codigo_de_barras"],
                             "contador"=>$value["contador"]
                         ]
                        );
                    
                }
            }
        );
        \Log::info('Cambios terminado de subir a la base de datos a las '.\Carbon\Carbon::now());
    }
}
