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
                                <div class="checkbox" style="margin: 0px 0 1em 0;">
                                    <label><input type="checkbox" class="check" value="{{$producto->pivot->id}}" {{$producto->pivot->empaquetado ? 'checked' : ''}}  {{$shopping_cart->order->empaquetado_at ? 'checked disabled' : ''}}  name="checked" id="checked" data-product="{{ $producto->id }}">Recibido</label>
                                </div>
                            {{-- </form> --}}

                        </td>
                        <td>{{$producto->descripcion}}</td>
                        <td>{{$producto->codigo_marzam}}</td>
                        <td>{{$producto->codigo_de_barras}}</td>
                        <td>{{$producto->codigo_sat}}</td>
                        <td>{{$producto->pivot->qty}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    $( document ).ready(function() {
        $('#checked').click(function(e) {
            var producto = $(this).val();
            console.log(producto);
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
            })
        });
    });
</script>