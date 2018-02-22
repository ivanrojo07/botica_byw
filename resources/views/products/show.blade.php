@extends('layouts.app')



@section('content')

    <div class="container" style="margin-top: 65px">

        @include("products.product", ["product" => $product])

    </div>



    {{--comentarios de los productos--}}

    @if(count($product_comments))

        <div class="container">

            <h3 class="grey">Reseñas:</h3>

            <ul>

                @foreach($product_comments as $comment)

                    <li class="grey">

                        {{ $comment->comment  }}

                    </li>

                @endforeach

            </ul>

        </div>

    @endif



@endsection