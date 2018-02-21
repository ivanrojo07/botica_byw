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

