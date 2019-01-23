<?php

namespace App\Http\Controllers;

use App\Factura;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class FacturasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $this->actualizaFactura();
        $facturas = Factura::get();
       
        

       return view('facturas.index',['facturas'=>$facturas]);
    }


    public function pagar(Request$request)
    {
        // dd($request->all());
        $factura =Factura::find($request->factura);
        $shopping_cart = $factura->in_shopping_cart;
        $shopping_cart->pagado = 1;
        $shopping_cart->save();
        return redirect()->route('facturas.index')->with(['feedback'=>'El producto '.$factura->nombre_prod.' se encuentra pagado.','alert_type' => 'alert-success']);


        
    }

    public function actualizaFactura()
    {
        $exist = Storage::disk('ftp')->exists('/out/F2173800.DAT');
        if($exist){
            $file = Storage::disk('ftp')->get('/out/F2173800.DAT');
            $array = explode('\n',$file);
            $ordenes = Order::where('verificado', 1)->get();
            foreach ($array as $medicamento) {
                $factura_num = substr($medicamento,8,10);
                $factura_fecha = substr($medicamento,18,8);
                $factura_prod = substr($medicamento,26,9);
                $nombre_prod=substr($medicamento,35,40);
                $codigo_bar=substr($medicamento,75,13);
                $clas_fis =substr($medicamento,88,2);
                $piezas = substr($medicamento,90,7);
                $prec_farm = substr($medicamento,104,10);
                $prec_bruto = substr($medicamento,134,13);
                $desc_oferta= substr($medicamento,147,6);
                $precio_desc= substr($medicamento,153,13);
                $desc_comercial=substr($medicamento,166,6);
                $prec_desc_comercial=substr($medicamento,172,13);
                $ieps=substr($medicamento,185,13);
                $iva=substr($medicamento,198,13);
                $bon_iva=substr($medicamento,211,13);
                $porc_utilidad=substr($medicamento,224,5);
                $neto=substr($medicamento,229,13);
                $neto_unit=substr($medicamento,257,10);


                $factura = Factura::updateOrCreate(
                    [
                        'numero'=>$factura_num,
                        'fecha'=>$factura_fecha,
                        'codigo_prod'=>$factura_prod
                    ],[
                        'numero'=>$factura_num,
                        'fecha'=>$factura_fecha,
                        'codigo_prod'=>$factura_prod,
                        'nombre_prod'=>$nombre_prod,
                        'codigo_bar'=>$codigo_bar,
                        'clas_fis'=>$clas_fis,
                        'piezas'=>$piezas,
                        'prec_farm'=>$prec_farm,
                        'prec_bruto'=>$prec_bruto,
                        'desc_oferta'=>$desc_oferta,
                        'precio_desc'=>$precio_desc,
                        'desc_comercial'=>$desc_comercial,
                        'prec_desc_comercial'=>$prec_desc_comercial,
                        'ieps'=>$ieps,
                        'iva'=>$iva,
                        'bon_iva'=>$bon_iva,
                        'porc_utilidad'=>$porc_utilidad,
                        'neto'=>$neto,
                        'neto_unit'=>$neto_unit,
                    ]);
                // SI ESTE PRODUCTO FACTURADO TODAVIA NO ESTA ASIGNADA A NINGUNA ORDEN SE LE ASIGNA
                foreach ($ordenes as $orden) {
                    $inShoppingCarts = $orden->shoppingCart->inShoppingCarts;
                    foreach ($inShoppingCarts as $shopping) {
                        if(!$shopping->factura && str_pad($shopping->qty,7,'0',STR_PAD_LEFT) == $factura->piezas && $factura->codigo_prod == (str_pad($shopping->product->codigo_marzam,9,'0',STR_PAD_LEFT) || str_pad($shopping->promotion->codigo_marzam,9,'0',STR_PAD_LEFT))){
                        // dd("si entra");
                        $factura->in_shopping_cart_id = $shopping->id;
                        $factura->save();
                        }
                    }
                }
            }            
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function show(Factura $factura)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function edit(Factura $factura)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Factura $factura)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function destroy(Factura $factura)
    {
        //
    }
}
