
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
  <div class="col col-sm-4">
    <div class="card my-2">
        <div class="card-header">
            <div class="pull-left">
                @if(Auth::check())
                    @if($favoriteProduct->isFavorite($product->id))
                        <a href="{{ url('/user/product/' . $product->id . '/favorite/remove') }}"
                        title="remover de favoritos">
                            <i class="fas fa-star"></i>
                        </a>
                    @else
                        <a href="{{ url('/user/product/' . $product->id . '/favorite/add') }}" title="agregar a favoritos">
                            <i class="far fa-star"></i>
                        </a>
                    @endif
                    <a href="{{ url('/user/product/' . $product->id . '/comment') }}" title="Valorar producto">
                        <i class="fa fa-comment"></i>
                    </a>
                @endif
                <h5 class="grey"><a href="{{ url('/products/'.$product->id) }}">{{$product["descripcion"]}}</a></h5>
            </div>
        </div>
        <center>
            <img class="card-img-top" src="{{ url("/img_marzam/".str_pad($product->codigo_marzam,7,'0',STR_PAD_LEFT).".jpg")}}" onerror="this.src='{{ asset('img/dummie.jpg') }}'" alt="Card image cap" style="max-width: 200px; max-height:200px;">
        </center>       
        <div class="card-body">
            <h5 class="grey text-center">
                <strong>Categoria:</strong>
            </h5>
            <p class="grey text-center">
                @if (isset($product->tipo_de_producto))
                    {{-- true expr --}}
                    @if ($product->tipo_de_producto == "ET")
                    {{-- expr --}}
                    MEDICAMENTOS GENERALES
                    @endif
                    @if ($product->tipo_de_producto == "VA")
                    {{-- expr --}}
                    VARIOS
                    @endif
                    @if ($product->tipo_de_producto == "PF")
                    {{-- expr --}}
                    PERFUMERÍA
                    @endif
                    @if ($product->tipo_de_producto == "MC")
                    {{-- expr --}}
                    MATERIAL DE CURACIÓN
                    @endif
                    @if ($product->tipo_de_producto == "OT")
                    {{-- expr --}}
                    MEDICAMENTOS GENERALES

                    @endif
                    @if ($product->tipo_de_producto == "CO")
                    {{-- expr --}}
                    CONTROLADO
                    @endif
                @else
                    Sin categoría
                    {{-- false expr --}}
                @endif
            </p>
            <div class="caption">
                @if (isset($product["sustancia_activa"]) && $product["sustancia_activa"] != "")
                    {{-- expr --}}
                    <h5 class="grey text-center">
                        <strong>Sustancia Activa:</strong>
                        <p class="grey">{{$product["sustancia_activa"]}}</p>
                    </h5>
                @else
                    <h5 class="grey">
                        <strong><br></strong>
                        <p class="grey"><br></p>
                    </h5>
                @endif
                <strong>
                    <p class="costo orangep text-center">
                            $  {{number_format((($product["precio_publico"]{{-- Precio al publico --}}+($product["precio_publico"]*($product["iva"]/100){{-- Agregando IVA --}})+($product["precio_publico"]*($product["ieps"]/100){{-- Agregando IEPS --}})+($product["precio_publico"]*($product["impuesto_3"]/100) {{-- Agregando otros impuestos --}})+($product['precio_publico']*(0.40)){{-- Agregando Porcentaje ganancia --}})/$cambio[0]{{-- Agregando Cambio de moneda(Dolares) --}}),2)}}  USD
                    </p>
                </strong>
                @include("in_shopping_carts.form",["product" => $product])
            </div>
        </div>
        
        
    </div>
</div>
