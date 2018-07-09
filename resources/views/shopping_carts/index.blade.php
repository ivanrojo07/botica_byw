@extends("layouts.app")
@section("content")
    <div class="big-padding text-center blue-grey white-text" style="    padding-top: 65px !important;">
        <h1>Tu carrito de compras</h1>
    </div>
    <div class="container margin-top">
        <table class="table table-bordered">
            <thead>
            <tr>
                <td>
                    <strong>Producto</strong>
                </td>
                <td>
                    <strong>Precio</strong>
                </td>
                <td>
                    <strong>Cantidad</strong>
                </td>
                <td>
                    <strong>Subtotal</strong>
                </td>
                <td>
                    <strong></strong>
                </td>
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
                        $ {{ number_format($product->pivot->qty * ((is_object($product->cat) && $product->cat->slug == 'Promociones') ? $product->promotion_pricing : $product->pivot->preciounit), 2) }}
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
    
    <script src="{{ asset('js/plugins/purify.min.js') }}"></script>
    
    
    
    
    
    
    
    <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/fileinput.css') }}" media="all" rel="stylesheet" type="text/css"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" media="all" rel="stylesheet" type="text/css"/>
    <link href="{{asset('themes/explorer-fa/theme.css')}}" media="all" rel="stylesheet" type="text/css"/>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="{{ asset('js/plugins/sortable.min.js') }}"></script>
    <script src="{{ asset('js/fileinput.min.js') }}"></script>
    <script src="{{ asset('js/locales/es.js') }}"></script>
    <script src="{{ asset('themes/explorer-fa/theme.js')}}" type="text/javascript"></script>
    <script src="{{ asset('themes/fa/theme.js')}}" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" type="text/javascript"></script>

    @if (Auth::check())
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
        {{-- expr --}}
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
    @endif
    <script>
        $('#receta').fileinput({
            theme: 'fa',
            language: 'es',
            showUpload: false,
            required: true,
            allowedFileExtensions: ["pdf", "jpg", "jpeg", "png"],
        });
        $('#receta').change(function(){
            alert("Hola");
        });
    </script>
@endsection

