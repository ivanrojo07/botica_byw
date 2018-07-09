<div class="col-sm-6 col-md-4">

	<div class="card bg-light pt-2 my-3">
        <center><img class="card-img-top" src="{{ url("/img_marzam/".str_pad($product->codigo_marzam,7,'0',STR_PAD_LEFT).".jpg")}}" onerror="this.src='{{ asset('img/dummie.jpg') }}'" alt="Card image cap" style="max-width: 200px; max-height:200px;"></center>
        <div class="card-body">
            <h5 class="card-title">{{ $product->nombre }}</h5>
            <div class="row">
                <div class="col-8 offset-2">
                    {!! Form::open(['url' => '/in_shopping_carts', 'method' => 'POST',"class" => " " ]) !!}
                    <input type="hidden" name="promotion_id" value="{{$product->id}}">
                    <input type="hidden" name="qty" value="1" > 
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                        </div>
                        <input type="text" readonly class="form-control" value="{{number_format((($product["precio_publico"]{{-- Precio al publico --}}+($product["precio_publico"]*($product["iva"]/100){{-- Agregando IVA --}})+($product["precio_publico"]*($product["ieps"]/100){{-- Agregando IEPS --}})+($product["precio_publico"]*($product["impuesto_3"]/100) {{-- Agregando otros impuestos --}})+($product['precio_publico']*(0.40)){{-- Agregando Porcentaje ganancia --}})/$cambio[0]{{-- Agregando Cambio de moneda(Dolares) --}}),2)}}  USD">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="submit">
                                <i class="price-text-color fa fa-shopping-cart"></i>
                            </button>                                                          
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>                                                
        </div>
    </div>
</div>