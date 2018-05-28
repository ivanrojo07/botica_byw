<div class="col-sm-6 col-md-4">
	<div class="thumbnail">
		<header class="text-center">
			<div class="pull-left">
			</div>
			<br>
			<h1 class="grey"><a href="{{ url('promotions/'.$product->id) }}">{{$product->nombre}}</a></h1>
		</header>
		<img class="bt1" src="{{ url("/img_marzam/".str_pad($product->codigo_marzam,7,'0',STR_PAD_LEFT).".jpg")}}" class="product_avatar" onerror="this.src='{{ asset('img/dummie.jpg') }}'">
		<strong>
        <p class="costo orangep text-center">
            @if(isset($promotion) && $promotion)
                $ {{$product->promotion_pricing}} usd
            @else
				$  {{number_format((($product["precio_publico"]{{-- Precio al publico --}}+($product["precio_publico"]*($product["iva"]/100){{-- Agregando IVA --}})+($product["precio_publico"]*($product["ieps"]/100){{-- Agregando IEPS --}})+($product["precio_publico"]*($product["impuesto_3"]/100) {{-- Agregando otros impuestos --}})+($product['precio_publico']*(0.40)){{-- Agregando Porcentaje ganancia --}})/$cambio[0]{{-- Agregando Cambio de moneda(Dolares) --}}),2)}}  USD
			@endif
        </p>
    </strong>
    @include('in_shopping_carts.formpromotion', ['product' => $product])
	</div>
</div>