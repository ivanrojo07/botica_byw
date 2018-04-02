<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class DownloadController extends Controller
{
    //

    function downloadFile(){

    	$contenidoCAT = Storage::disk('ftp')->get('/out/CATALOGO.CSV');
    	Storage::put('public/CATALOGO.csv', $contenidoCAT);
    	$contenidoCAM = Storage::disk('ftp')->get('/out/CAMBIOS.CSV');
    	Storage::put('public/CAMBIOS.csv', $contenidoCAM);

    	// return response()->make($contenido, '200', array(
     //            'Content-Type' => 'application/octet-stream',
     //            'Content-Disposition' => 'attachment; filename="'.'CATALOGO.CSV'.'"'
     //        ));
    	 // return Response::make
  //   	$file = $request->get('file');
  //   	if (!$file) {
  //   		# code...
  //   		return response()->json('obtener un archivo valido', 400);
  //   	}
  //   	$fileName = basename($file);
		// $ftp = Storage::createFtpDriver([
	 //                    'host'     => 'your_host',
	 //                    'username' => 'your_ftp_user',
	 //                    'password' => 'your_ftp_user_password',
	 //                    'port'     => '21', // your ftp port
	 //                    'timeout'  => '30', // timeout setting 
	 //      ]); 
  //   	$filecontent = Storage::get($file); // read file content 
  //          // download file.
  //          return Response::make($filecontent, '200', array(
  //               'Content-Type' => 'application/octet-stream',
  //               'Content-Disposition' => 'attachment; filename="'.$fileName.'"'
  //           ));
    }
}
