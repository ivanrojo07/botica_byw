<?php

namespace App\Http\Controllers;

use App\Catalogo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileController extends Controller
{
    //

    public function importarExcel(){
    	return view('excel.file_import_export');

    }

    public function importFileIntoDB(Request $request){
    	// dd($request->all());
    	// $catalogo = new Catalogo();
    	// dd($catalogo);
    	if ($request->hasFile('sample_file')) {
    		# code...
            // dd($request->file('sample_file')->getPathName());
    		$path = $request->file('sample_file')->getPathName();
            // dd(storage_path('public/CATALOGO.csv'));
            Excel::filter('chunk')->load(storage_path("app\public\CATALOGO.csv"),null,null,true,null)->chunk(250, function($results) {
            	// dd($results);
            	foreach ($results as $key => $value) {
                	# code...
    				// dd($value);
    				// $descripcion = iconv('ASCII//TRANSLIT', 'UTF-8',  $value["descripcion_terapeutica"]);
    				// dd($descripcion);
                    set_time_limit(0); 
         //            if ($value["descipcion"]) {
         //            	# code...
         //            	$catalogo = Catalogo::updateOrCreate(
	    				// 	[
	    				// 		"codigo_marzam"=>$value["codigo_marzam"]
	    				// 	]
	    				// 	,[
		    			// 		"fecha_actual"=>$value["fecha_actual"],
		    			// 		"codigo_marzam"=>$value["codigo_marzam"],
		    			// 		"descripcion"=>preg_replace('/\s\s+/', '', $value["descipcion"]),
		    			// 		// "descripcion"=>preg_replace('/\s\s+/', '', $value["descipcion"]),
		    			// 		"precio_farmacia"=>$value["precio_farmacia"],
		    			// 		"precio_publico"=>$value["precio_publico"],
		    			// 		"iva"=>$value["iva"],
		    			// 		"ieps"=>$value["ieps"],
		    			// 		"impuesto_3"=>$value["impuesto_3"],
		    			// 		"clasificacion_fiscal"=>$value["clasificacion_fiscal"],
		    			// 		"codigo_de_barras"=>$value["codigo_de_barras"],
		    			// 		"contador"=>$value["contador"]
		    			// 	]
		    			// );
         //            }
         //            elseif ($value["descripcion"]) {
         //            	# code...
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
		    					"codigo_de_barras"=>$value["codigo_de_barras"],
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
                    // }
                    // else{

	    				
                    // }
    				
                }
                return redirect()->back()->with('success', 'Archivo subido correctamente.');
			});
      //       $data = \Excel::load($path,null,null,true,null)->get();
    		// if ($data->count()) {
    		// 	# code...
      //           // dd($data);
    		// 	foreach ($data as $key => $value) {
    		// 		# code...
    		// 		// dd($value);
    		// 		$descripcion = utf8_encode($value["descripcion_terapeutica"]);
    		// 		// dd($descripcion);
    		// 		$catalogo = Catalogo::create[
    		// 			"Fecha Actual"=>$value["fecha_actual"],
    		// 			"Codigo Marzam"=>$value["codigo_marzam"],
    		// 			"Descripcion"=>$value["descripcion"],
    		// 			"Precio Farmacia"=>$value["precio_farmacia"],
    		// 			"Precio Publico"=>$value["precio_publico"],
    		// 			"% IVA"=>$value["iva"],
    		// 			"% IEPS"=>$value["ieps"],
    		// 			"Impuesto 3"=>$value["impuesto_3"],
    		// 			"Tipo de Producto"=>$value["tipo_de_producto"],
    		// 			"Laboratorio"=>$value["laboratorio"],
    		// 			"Clasificacion Fiscal"=>$value["clasificacion_fiscal"],
    		// 			"Descripcion Terapeutica"=>$value["descripcion_terapeutica"],
    		// 			"Sustancia Activa"=>$value["sustancia_activa"],
    		// 			"Refrigerado"=>$value["refrigerado"],
    		// 			"Controlado"=>$value["controlado"],
    		// 			"Codigo de Barras"=>$value["codigo_de_barras"],
    		// 			"Unidad de Venta"=>$value["unidad_de_venta"],
    		// 			"Fecha de Caducidad"=>$value["fecha_de_caducidad"],
    		// 			"Grupo SSA"=>$value["grupo_ssa"],
    		// 			"Accion Sobre Articulo"=>$value["accion_sobre_articulo"],
    		// 			"Pzas. Empaque Original"=>$value["pzas._empaque_original"],
    		// 			"Descuento Comercial %"=>$value["descuento_comercial"],
    		// 			"Codigo SAT"=>$value["codigo_sat"],
    		// 			" Unidad SAT"=>$value["unidad_sat"],
    		// 			"Contador"=>$value["contador"]
    		// 		];
    		// 		$arr[]=[$catalogo];
      //           }
      //           // dd($arr);
    		// 	if (!empty($arr)) {
    		// 		# code...
    		// 		// set_time_limit(0);
    		// 		// DB::table('catalogo')->insert($arr);
    		// 		return redirect()->back()->with('success', 'Archivo subido correctamente.');
    		// 	} else {
    		// 		# code...
    		// 		return redirect()->back()->with('error', 'Error al subir el archivo.');
    		// 	}
    			
    		// } else {
    		// 	# code...
    		// 	return redirect()->back()->with('error', 'Error al subir el archivo.');
    		// }
    		
    	} else {
    		# code...
    		return redirect()->back()->with('error', 'No se subio ningun archivo');
    	}
    	return redirect()->back()->with('error', 'Error al subir el archivo.');
    }
}
