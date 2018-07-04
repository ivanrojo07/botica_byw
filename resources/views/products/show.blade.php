@extends('layouts.app')
@section('content')
    <div class="container" style="margin-top: 65px">
        
        <div class="col-md-offset-2 col-sm-offset-4">
            @include("products.product", ["product" => $product])
        </div>
    {{--comentarios de los productos--}}
    @if(count($product_comments))
        <div class="col-sm-6 col-md-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Reseñas de {{$product["descripcion"]}} :</h3>
                </div>
                <br>
                @foreach($product_comments as $comment)
                    <div class="panel panel-info">
                        <div class="panel-body">
                            <li class="grey">
                                {{ $comment->comment  }}
                            </li>                      
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <div class="col-sm-6 col-md-4">
            <div class="panel panel-info">
                <div class="panel-body">
                    <p class="grey">
                        El producto todavía no tiene reseñas
                    </p>
                </div>
            </div>
        </div>
    @endif
        </div>
    </div>
@endsection