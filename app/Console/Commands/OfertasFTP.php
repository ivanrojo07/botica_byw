<?php

namespace App\Console\Commands;

use App\Promotion;
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
                    // dd($value);
                    if ($value["ean"] != "             ") {
                        # code...
                        $promocion = Promotion::updateOrCreate(
                            [
                                "codigo_marzam"=>$value["codigo_marzam"]
                            ]
                            ,
                            [
                                "fecha" => $value["fecha_actual"],
                                "codigo_marzam" =>$value["codigo_marzam"],
                                "nombre" =>preg_replace('/\s\s+/', '', $value["descripcion"]),
                                "precio_farmacia" =>$value["precio_farmacia"],
                                "precio_publico" =>$value["precio_publico"],
                                "iva" =>$value["iva"],
                                "ieps" =>$value["ieps"],
                                // "impuesto_3" =>($value["impuesto_3"]) ? $value["impuesto_3"] : "",
                                "constante" =>$value["constante"],
                                "cantidad_base" =>$value["cantidad_base"],
                                "cantidad_oferta" =>$value["cantidad_oferta"],
                                "porcentaje_oferta" =>$value["oferta"],
                                "fecha_inicio" =>$value["vigencia_inicio"],
                                "fecha_fin" =>$value["vigencia_fin"],
                                "codigo_barras" =>$value["ean"],
                                "descuento_comercial" =>$value["descuento_estandar"],
                                "numero_registro" =>$value["contador"],

                            ]
                        );
                    }
                }
            }
        );
         \Log::info('Catalogo terminado de subir a la base de datos a las '.\Carbon\Carbon::now());
    }
}
