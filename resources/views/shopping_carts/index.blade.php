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

            @foreach($products as $product)

                <tr>

                    <td>

                        {{$product->title}}

                        @if(is_object($product->cat) && $product->cat->slug == 'Promociones')

                            <label class="text-info">(Producto en Promoción)</label>

                        @endif

                    </td>

                    <td>

                        @if(is_object($product->cat) && $product->cat->slug == 'Promociones')

                            $ {{$product->promotion_pricing}}

                        @else

                            $ {{$product->pricing}}

                        @endif



                    </td>

                    <td>

                        {{ $product->pivot->qty }}

                    </td>

                    <td>

                        $ {{ number_format($product->pivot->qty * ((is_object($product->cat) && $product->cat->slug == 'Promociones') ? $product->promotion_pricing : $product->pricing), 2) }}

                    </td>

                    <td>

                        @include("shopping_carts.delete")

                    </td>



                </tr>

            @endforeach



            <tr class="background-blueth">

                <td></td>

                <td></td>

                <td class="t-r f-b">Total</td>

                <td>$ {{$total}} </td>

            </tr>



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
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="{{ asset('js/plugins/piexif.min.js') }}"></script>
    <script src="{{ asset('js/plugins/sortable.min.js') }}"></script>
    <script src="{{ asset('js/plugins/purify.min.js') }}"></script>
    <script src=""></script>
    <!-- popper.min.js below is needed if you use bootstrap 4.x. You can also use the bootstrap js 
   3.3.x versions without popper.min.js. -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <!-- bootstrap.min.js below is needed if you wish to zoom and preview file content in a detail modal
    dialog. bootstrap 4.x is supported. You can also use the bootstrap js 3.3.x versions. -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="{{ asset('js/fileinput.min.js') }}"></script>
    <script src="{{ asset('js/locales/es.js') }}"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
    <script>
        $('#receta').fileinput({
            theme: 'fa',
            language: 'es',
            showUpload: false,
            required: true,
            allowedFileExtensions: ["pdf", "jpg", "jpeg", "png"],
        });
    </script>
@endsection

