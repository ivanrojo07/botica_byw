<div class="container">
	<h4 class="modal-title grey" id="myModalLabel">

        Productos  comprados:

    </h4>

    <div class="col-lg-12">
        <table class="table" style=" padding: 5px !important;max-width: 60% !important;">
            <thead>
                <tr>
                    <td>Check</td>
                    <td>Nombre del producto</td>
                    <td>Código Marzam</td>
                    <td>Código de Barras</td>
                    <td>Código SAT</td>
                    <td>Cantidad</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($productos as $producto)
                    {{-- expr --}}
                    <tr>
                        <td>
                            {{-- <form action="{{ url('/producto_check') }}" method="POST" style="margin: -8px 0 1em 0;">
 --}}
                                {{-- {{ csrf_field() }} --}}
                                @if ($producto->pivot->pagado == 1)
                                    {{-- expr --}}
                                <div class="checkbox producto" style="margin: 0px 0 1em 0;">
                                    <label><input type="checkbox" class="check" value="{{$producto->pivot->id}}" {{$producto->pivot->empaquetado ? 'checked' : ''}}  {{$shopping_cart->order->empaquetado_at ?  'checked disabled' : ''}}  name="checked" id="checked_prod {{$producto->id}}" onclick="checkingProducto({{$producto->id}})" data-product="{{ $producto->id }}">Recibido</label>
                                </div>
                                @endif
                                @if ($producto->pivot->pagado)
                                {{-- true expr --}}
                                    <span class="badge badge-info">Pagado</span>
                                @else
                                    {{-- false expr --}}
                                    <span class="badge badge-danger">Sin pagar</span>

                                @endif
                            {{-- </form> --}}

                        </td>
                        <td>{{$producto->codigo_marzam}}</td>
                        <td>
                            {{$producto->descripcion}} 

                        </td>
                        <td>{{$producto->codigo_de_barras}}</td>
                        <td>{{$producto->codigo_sat}}</td>
                        <td>{{$producto->pivot->qty}}</td>
                    </tr>
                @endforeach
                @foreach ($promotions as $promotion)
                    {{-- expr --}}
                    <tr>
                        <td>
                            {{-- <form action="{{ url('/producto_check') }}" method="POST" style="margin: -8px 0 1em 0;">
 --}}
                                {{-- {{ csrf_field() }} --}}
                                <div class="checkbox promotion" style="margin: 0px 0 1em 0;">
                                    <label><input type="checkbox" class="check" value="{{$promotion->pivot->id}}" {{$promotion->pivot->empaquetado ? 'checked' : ''}}  {{$shopping_cart->order->empaquetado_at ? 'checked disabled' : ''}}  name="checked" onclick="checkingPromotion({{$promotion->id}})" id="checked_prom {{$promotion->id}}" data-promotion="{{ $promotion->id }}">Recibido</label>
                                </div>
                            {{-- </form> --}}

                        </td>
                        <td>{{$promotion->nombre}}</td>
                        <td>{{$promotion->codigo_marzam}}</td>
                        <td>{{$promotion->codigo_barras}}</td>
                        <td>PROMOCIÓN</td>
                        <td>{{$promotion->pivot->qty}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script>
    function checkingProducto(id){
        var producto = document.getElementById("checked_prod "+id).value;
        console.log(id);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '{{ url('/producto_check') }}',
            type: 'POST',
            data: {
                checked: producto
            },
            success: function(data){
                // $(this).attr("disabled", data);
            }
        });
    }
    function checkingPromotion(id) {
        // body...
        var promotion = document.getElementById("checked_prom "+id).value;
        console.log(promotion);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: '{{ url('/promotion_check') }}',
            type: 'POST',
            data: {
                checked: promotion
            },

            success: function(data){
                // $(this).attr("disabled", data);
            }
        });
    }
</script>
</script>