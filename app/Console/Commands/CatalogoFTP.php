<?php

namespace App\Console\Commands;

use App\Catalogo;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class CatalogoFTP extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'excel:upload';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sube los catalogos que se encuentran en cambios.csv a la base de datos.';

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
        \Log::info('Iniciando la subide del catalogo a la base de datos a las '.\Carbon\Carbon::now());
        Excel::filter('chunk')->load(storage_path("/app/public/CATALOGO.csv"),null,null,true,null)->chunk(250, function($results) {
                // dd($results);
                foreach ($results as $key => $value) {
                    # code...
                    // dd($value);
                    // $descripcion = iconv('ASCII//TRANSLIT', 'UTF-8',  $value["descripcion_terapeutica"]);
                    // dd($descripcion);
                    set_time_limit(0); 
         //            if ($value["descipcion"]) {
         //             # code...
         //             $catalogo = Catalogo::updateOrCreate(
                        //  [
                        //      "codigo_marzam"=>$value["codigo_marzam"]
                        //  ]
                        //  ,[
                        //      "fecha_actual"=>$value["fecha_actual"],
                        //      "codigo_marzam"=>$value["codigo_marzam"],
                        //      "descripcion"=>preg_replace('/\s\s+/', '', $value["descipcion"]),
                        //      // "descripcion"=>preg_replace('/\s\s+/', '', $value["descipcion"]),
                        //      "precio_farmacia"=>$value["precio_farmacia"],
                        //      "precio_publico"=>$value["precio_publico"],
                        //      "iva"=>$value["iva"],
                        //      "ieps"=>$value["ieps"],
                        //      "impuesto_3"=>$value["impuesto_3"],
                        //      "clasificacion_fiscal"=>$value["clasificacion_fiscal"],
                        //      "codigo_de_barras"=>$value["codigo_de_barras"],
                        //      "contador"=>$value["contador"]
                        //  ]
                        // );
         //            }
         //            elseif ($value["descripcion"]) {
                    if ($value["tipo_de_producto"]  != "CO" && $value["tipo_de_producto"]  != "ET") {
         //             # code...
         //             # code...
                        if ($value["codigo_de_barras"] != "             ") {
                            # code...
                            $catalogo = Catalogo::updateOrCreate(
                                [
                                    "codigo_marzam"=>$value["codigo_marzam"],
                                ]
                                ,[
                                    "fecha_actual"=>$value["fecha_actual"],
                                    "codigo_marzam"=>$value["codigo_marzam"],
                                    "descripcion"=>preg_replace('/\s\s+/', '', $value["descripcion"]),
                                    // "descripcion"=>preg_replace('/\s\s+/', '', $value["descipcion"]),
                                    "precio_farmacia"=>$value["precio_farmacia"],
                                    "precio_publico"=>$value["precio_publico"],
                                    "iva"=>$value["iva"],
                                    "ieps"=>$value["ieps"],
                                    "impuesto_3"=>$value["impuesto_3"],
                                    "tipo_de_producto"=>$value["tipo_de_producto"],
                                    "laboratorio"=>preg_replace('/\s\s+/', '',$value["laboratorio"]),
                                    "clasificacion_fiscal"=>$value["clasificacion_fiscal"],
                                    "descripcion_terapeutica"=>preg_replace('/\s\s+/', '', $value["descripcion_terapeutica"]),
                                    "sustancia_activa"=>preg_replace('/\s\s+/', '', $value["sustancia_activa"]),
                                    "refrigerado"=>$value["refrigerado"],
                                    "controlado"=>$value["controlado"],
                                    "codigo_de_barras"=> ($value["codigo_de_barras"] == "" ? "0000": $value["codigo_de_barras"]),
                                    "unidad_de_venta"=>$value["unidad_de_venta"],
                                    "fecha_de_caducidad"=>$value["fecha_de_caducidad"],
                                    "grupo_ssa"=>$value["grupo_ssa"],
                                    "accion_sobre_articulo"=>$value["accion_sobre_articulo"],
                                    "pzas_empaque_original"=>$value["pzas._empaque_original"],
                                    "descuento_comercial"=>$value["descuento_comercial"],
                                    "codigo_sat"=>$value["codigo_sat"],
                                    "unidad_sat"=>$value["unidad_sat"],
                                    "contador"=>$value["contador"]
                                ]
                            );
                        }
                    }
                    // else{

                        
                    // }
                    
                }
            }
        );
        \Log::info('Catalogo terminado de subir a la base de datos a las '.\Carbon\Carbon::now());
    }
}
