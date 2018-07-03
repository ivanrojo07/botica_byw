

  <div class="col-sm-6 col-md-4">
    <div class="thumbnail">
    <header class="text-center">
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
        </div>
        <br>
        <h1 class="grey"><a href="{{ url('/products/'.$product->id) }}">{{$product["descripcion"]}}</a></h1>
    </header>
        <div class="caption">
        <h5 class="grey text-center">
            <strong>Categoria:</strong>
        </h5>
    <p class="grey text-center">
        @if (isset($product->tipo_de_producto))
            {{-- true expr --}}
            @if ($product->tipo_de_producto == "ET")
               {{-- expr --}}
               ÉTICO
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
               MEDICAMENTOS DE VENTA LIBRE

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
            @if(isset($promotion) && $promotion)
                $ {{$product->promotion_pricing}} usd
            @else
                $  {{number_format((($product["precio_publico"]{{-- Precio al publico --}}+($product["precio_publico"]*($product["iva"]/100){{-- Agregando IVA --}})+($product["precio_publico"]*($product["ieps"]/100){{-- Agregando IEPS --}})+($product["precio_publico"]*($product["impuesto_3"]/100) {{-- Agregando otros impuestos --}})+($product['precio_publico']*(0.40)){{-- Agregando Porcentaje ganancia --}})/$cambio[0]{{-- Agregando Cambio de moneda(Dolares) --}}),2)}}  USD
            @endif
        </p>
    </strong>
    @include("in_shopping_carts.form",["product" => $product])
      </div>
    </div>
  </div>
