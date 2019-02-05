@extends("layouts.app")
@section("content")
    <div class="big-padding text-center blue-grey white-text" style="    padding-top: 65px !important;">
        <h1>Tu carrito de compras</h1>
    </div>
    <div class="container margin-top">
        <table class="table table-responsive-md table-bordered">
            <thead>
            <tr>
                <th scope="col">
                    <strong>Producto</strong>
                </th>
                <th scope="col">
                    <strong>Precio</strong>
                </th>
                <th scope="col">
                    <strong>Cantidad</strong>
                </th>
                <th scope="col">
                    <strong>Subtotal</strong>
                </th>
                <th scope="col">
                    <strong></strong>
                </th>
            </tr>
            </thead>
            <tbody>
                {{-- {{dd($envio)}} --}}
            @foreach($products as $product)
                <tr>
                    <td>
                        {{$product->descripcion}}
                        @if(is_object($product->cat) && $product->cat->slug == 'Promociones')
                            <label class="text-info">(Producto en Promoción)</label>
                        @endif
                    </td>
                    <td>
                        @if(is_object($product->cat) && $product->cat->slug == 'Promociones')
                            $ {{$product->promotion_pricing}}
                        @else
                            $ {{$product->pivot->preciounit}}
                        @endif


                    </td>
                    <td>
                        {{ $product->pivot->qty }}
                    </td>
                    <td>
                        $ {{ number_format($product->pivot->qty * ((is_object($product->cat) && $product->cat->slug == 'Promociones') ? $product->promotion_pricing : $product->pivot->preciounit), 2) }} USD
                    </td>
                    <td>
                        @include("shopping_carts.delete")
                    </td>
                </tr>
            @endforeach
            @foreach($promotions as $product)
                <tr>
                    <td>
                        {{$product->nombre}}
                            <label class="text-info">(Producto en Promoción)</label>
                    </td>
                    <td>
                        @if(is_object($product->cat) && $product->cat->slug == 'Promociones')
                            $ {{$product->promotion_pricing}}
                        @else
                            $ {{$product->pivot->preciounit}}
                        @endif
                    </td>
                    <td>
                        {{ $product->pivot->qty }}
                    </td>
                    <td>
                        $ {{ number_format($product->pivot->qty * ((is_object($product->cat) && $product->cat->slug == 'Promociones') ? $product->promotion_pricing : $product->pivot->preciounit), 2) }}
                    </td>
                    <td>
                        @include("shopping_carts.delete_promotion")
                    </td>
                </tr>
            @endforeach
            <tbody id="envios">
            </tbody>
            </tbody>
        </table>
        <div>
            @include("shopping_carts.form")
        </div>
        <p class="text-center" style="color: black;"><strong>El tiempo estimado de la entrega es de 5 a 7 dias habiles</strong></p>
    </div>
@endsection
@section('scripts')
    {{-- expr --}}
    
    
    
    <script src="{{ asset('js/plugins/piexif.min.js') }}"></script>
    
    <link href="{{ asset('css/fileinput.css') }}" media="all" rel="stylesheet" type="text/css"/>
   
    <script src="{{ asset('js/plugins/sortable.min.js') }}"></script>
    <script src="{{ asset('js/fileinput.min.js') }}"></script>
    <script src="{{ asset('js/locales/es.js') }}"></script>
    <script src="{{ asset('themes/explorer-fa/theme.js')}}" type="text/javascript"></script>
    <script src="{{ asset('themes/fa/theme.js')}}" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" type="text/javascript"></script>

    {{-- @if (Auth::check())
        <script>
            $(document).ready(function(){
                direccion = $('input[name=direccion_default]:checked').val();
                console.log(direccion);
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url:"http://country.io/phone.json",
                    type: "GET",
                    dataType:"application/json",
                    success:function (data) {
                        console.log("country ",data);
                    }
                })
                $.ajax({
                    url: "{{ url('/envioshopping') }}",
                    type: "POST",
                    // dataType: "html",
                    data: {
                        direccion_id: direccion,
                        envio_id: {{$envio->id}},
                        total: {{$total}},
                    },
                    success: function(data){
                        $('#envios').html(data);
                    }
                });
                $('input[name=direccion_default]').change(function(){
                    direccion = $('input[name=direccion_default]:checked').val();
                    $.ajax({
                        url: "{{ url('/envioshopping') }}",
                        type: "POST",
                        // dataType: "html",
                        data: {
                            direccion_id: $('input[name=direccion_default]:checked').val(),
                            envio_id: {{$envio->id}},
                            total: {{$total}},
                        },
                        success: function(data){
                            $('#envios').html(data);
                        }
                    });
                });

            });
            
        </script>
    @else
        <script>
            $(document).ready(function(){
            
                direccion = {{ isset($direccion_default->id) ? "$direccion_default->id" : "$('input[name=direccion_default]:checked').val()"}};
                console.log(direccion);
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ url('/envioshopping') }}",
                    type: "POST",
                    // dataType: "html",
                    data: {
                        direccion_id: direccion,
                        envio_id: {{$envio->id}},
                        total: {{$total}},
                    },
                    success: function(data){
                        $('#envios').html(data);
                    }
                });
                $('input[name=direccion_default]').change(function(){
                    direccion = $('input[name=direccion_default]:checked').val();
                    $.ajax({
                        url: "{{ url('/envioshopping') }}",
                        type: "POST",
                        // dataType: "html",
                        data: {
                            direccion_id: $('input[name=direccion_default]:checked').val(),
                            envio_id: {{$envio->id}},
                            total: {{$total}},
                        },
                        success: function(data){
                            $('#envios').html(data);
                        }
                    });
                });

            });
        </script>
    @endif --}}
    <script>
        $('#receta').fileinput({
            theme: 'fa',
            language: 'es',
            showUpload: false,
            required: true,
            allowedFileExtensions: ["pdf", "jpg", "jpeg", "png"],
        });
        $('#receta').change(function(){
           
        });
    </script>
@endsection

