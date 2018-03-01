<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
    	if ($request->hasFile('sample_file')) {
    		# code...
            // dd($request->file('sample_file')->getPathName());
    		$path = $request->file('sample_file')->getPathName();
            // dd($path);
            $data = \Excel::load($path,null,null,true,null)->get();
    		if ($data->count()) {
    			# code...
                // dd($data);
    			foreach ($data as $key => $value) {
    				# code...
    				// dd($value);
    				$descripcion = utf8_encode($value["descripcion_terapeutica"]);
    				dd($descripcion);
    				$arr[]=[
    					"Fecha Actual"=>$value["fecha_actual"],
    					"Codigo Marzam"=>$value["codigo_marzam"],
    					"Descripcion"=>$value["descripcion"],
    					"Precio Farmacia"=>$value["precio_farmacia"],
    					"Precio Publico"=>$value["precio_publico"],
    					"% IVA"=>$value["iva"],
    					"% IEPS"=>$value["ieps"],
    					"Impuesto 3"=>$value["impuesto_3"],
    					"Tipo de Producto"=>$value["tipo_de_producto"],
    					"Laboratorio"=>$value["laboratorio"],
    					"Clasificacion Fiscal"=>$value["clasificacion_fiscal"],
    					"Descripcion Terapeutica"=>$value["descripcion_terapeutica"],
    					"Sustancia Activa"=>$value["sustancia_activa"],
    					"Refrigerado"=>$value["refrigerado"],
    					"Controlado"=>$value["controlado"],
    					"Codigo de Barras"=>$value["codigo_de_barras"],
    					"Unidad de Venta"=>$value["unidad_de_venta"],
    					"Fecha de Caducidad"=>$value["fecha_de_caducidad"],
    					"Grupo SSA"=>$value["grupo_ssa"],
    					"Accion Sobre Articulo"=>$value["accion_sobre_articulo"],
    					"Pzas. Empaque Original"=>$value["pzas._empaque_original"],
    					"Descuento Comercial %"=>$value["descuento_comercial"],
    					"Codigo SAT"=>$value["codigo_sat"],
    					" Unidad SAT"=>$value["unidad_sat"],
    					"Contador"=>$value["contador"]
    				];
                }
                // dd($arr);
    			if (!empty($arr)) {
    				# code...
    				DB::table('catalogo')->insert($arr);
    				return redirect()->back()->with('success', 'Archivo subido correctamente.');
    			} else {
    				# code...
    				return redirect()->back()->with('error', 'Error al subir el archivo.');
    			}
    			
    		} else {
    			# code...
    			return redirect()->back()->with('error', 'Error al subir el archivo.');
    		}
    		
    	} else {
    		# code...
    		return redirect()->back()->with('error', 'No se subio ningun archivo');
    	}
    	return redirect()->back()->with('error', 'Error al subir el archivo.');
    }
}
