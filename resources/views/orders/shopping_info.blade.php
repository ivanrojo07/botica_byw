<div class="container">
	<h4 class="modal-title grey" id="myModalLabel">
        Productos  comprados:
    </h4>
@foreach ($productos as $element =>$producto)
	<div class="col">
        <h5 class="modal-title grey" id="myModalLabel">
            <strong>Producto #{{$element +1}}:</strong>
        </h5>
        <div class="col">
            Nombre del producto: {{ $producto->descripcion }}
        </div>
        <div class="col">
            Codigo Marzam: {{ $producto->codigo_marzam }}
        </div>
        <div class="col">
            Codigo de Barras: {{ $producto->codigo_de_barras }}
        </div>
        <div class="col">
            Codigo SAT: {{ $producto->codigo_sat }}
        </div>
        <div class="col">
            Precio en Farmacia: ${{number_format((($producto["precio_farmacia"]{{-- Precio farmacia --}}+($producto["precio_farmacia"]*($producto["iva"]/100){{-- Agregando IVA --}})+($producto["precio_farmacia"]*($producto["ieps"]/100){{-- Agregando IEPS --}})+($producto["precio_farmacia"]*($producto["impuesto_3"]/100) {{-- Agregando otros impuestos --}}))),2)}} MXN
        </div>
        <div class="col">
        	Cantidad comprada: {{ $producto->pivot->qty}}
        </div>
        <div class="col">
        	Total a pagar: ${{number_format((($producto["precio_farmacia"]{{-- Precio farmacia --}}+($producto["precio_farmacia"]*($producto["iva"]/100){{-- Agregando IVA --}})+($producto["precio_farmacia"]*($producto["ieps"]/100){{-- Agregando IEPS --}})+($producto["precio_farmacia"]*($producto["impuesto_3"]/100) {{-- Agregando otros impuestos --}}))),2)*$producto->pivot->qty}} MXN
        </div>
    </div>
@endforeach
@foreach ($promotions as  $element =>$promotion)
    {{-- expr --}}
    <div class="col">
        <h5 class="modal-title grey" id="myModalLabel">
            <strong>Promoción #{{$element +1}}:</strong>
        </h5>
        <div class="col">
            Nombre del producto: {{ $promotion->nombre }}
        </div>
        <div class="col">
            Codigo Marzam: {{ $promotion->codigo_marzam }}
        </div>
        <div class="col">
            Codigo de Barras: {{ $promotion->codigo_barras }}
        </div>
        <div class="col">
            Precio en Farmacia: ${{number_format((($promotion["precio_farmacia"]{{-- Precio farmacia --}}+($promotion["precio_farmacia"]*($promotion["iva"]/100){{-- Agregando IVA --}})+($promotion["precio_farmacia"]*($promotion["ieps"]/100){{-- Agregando IEPS --}})+($promotion["precio_farmacia"]*($promotion["impuesto_3"]/100) {{-- Agregando otros impuestos --}}))),2)}} MXN
        </div>
        <div class="col">
            Cantidad comprada: {{ $promotion->pivot->qty}}
        </div>
        <div class="col">
            Total a pagar: ${{number_format((($promotion["precio_farmacia"]{{-- Precio farmacia --}}+($promotion["precio_farmacia"]*($promotion["iva"]/100){{-- Agregando IVA --}})+($promotion["precio_farmacia"]*($promotion["ieps"]/100){{-- Agregando IEPS --}})+($promotion["precio_farmacia"]*($promotion["impuesto_3"]/100) {{-- Agregando otros impuestos --}}))),2)*$promotion->pivot->qty}} MXN
        </div>
    </div>
@endforeach
</div>