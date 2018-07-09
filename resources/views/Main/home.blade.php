@extends('layouts.app')
@section('content')
    <!-- Banner -->

    <div class="container-fluid mt-0 pt-3 background-image" style="background-image:{{url('img/bg-banner.jpg')}}">

        <div class="row">
            <!--JUMBO-->
                <div class="col col-sm-7">
                    <div class="jumbotron" style="background: rgba(255, 255, 255, 0.51);">
                        <h2>TuFarmaciaLatina.com</h2>
                        <p class="lead"><strong> Enviamos a toda Latinoamerica Incluyendo a VENEZUELA Y CUBA.</strong></p>
                        <hr class="my-4">
                        <a href="{{ url('/seguimiento')}}"><p><strong>¡Dale Seguimiento a tu pedido!</strong></p></a>
                        <p class="lead">
                            <a class="btn btn-primary btn-lg" href="{{ url('/Products1')}}" role="button">¡COMPRAR!</a>
                        </p>
                    </div>
                </div>
            <!--SLIDER_1-->
                <div class="col d-none d-sm-block">
                    <div id="carouselExampleSlidesOnly" class="carousel slide" data-interval="2300" data-ride="carousel">
                        <div class="carousel-inner">
                            @foreach($products_slider1 as $producto1)
                                @if ($loop->first)
                                    <div class="carousel-item active">
                                @else
                                    <div class="carousel-item">
                                @endif
                                <div class="row no-gutters">
                                    <div class="col-8 offset-2">
                                        <div class="card bg-light pt-2">
                                            <center><img class="card-img-top" src="{{ url("/img_marzam/".str_pad($producto1->codigo_marzam,7,'0',STR_PAD_LEFT).".jpg")}}" onerror="this.src='{{ asset('img/dummie.jpg') }}'" alt="Card image cap" style="max-width: 200px; max-height:200px;"></center>
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $producto1->nombre }}</h5>
                                                <div class="row">
                                                    <div class="col-8 offset-2">
                                                        {!! Form::open(['url' => '/in_shopping_carts', 'method' => 'POST',"class" => " " ]) !!}
                                                        <input type="hidden" name="promotion_id" value="{{$producto1->id}}">
                                                        <input type="hidden" name="qty" value="1" > 
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">$</span>
                                                            </div>
                                                            <input type="text" readonly class="form-control" value="{{number_format((($producto1["precio_publico"]{{-- Precio al publico --}}+($producto1["precio_publico"]*($producto1["iva"]/100){{-- Agregando IVA --}})+($producto1["precio_publico"]*($producto1["ieps"]/100){{-- Agregando IEPS --}})+($producto1["precio_publico"]*($producto1["impuesto_3"]/100) {{-- Agregando otros impuestos --}})+($producto1['precio_publico']*(0.40)){{-- Agregando Porcentaje ganancia --}})/$cambio[0]{{-- Agregando Cambio de moneda(Dolares) --}}),2)}}  USD">
                                                            <div class="input-group-append">
                                                                <button class="btn btn-outline-secondary" type="submit">
                                                                    <i class="price-text-color fa fa-shopping-cart"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        {!! Form::close() !!}
                                                    </div>
                                                </div>                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @foreach($products_slider as $product)
                            <div class="carousel-item">
                                <div class="row no-gutters">
                                    <div class="col-8 offset-2">
                                        <div class="card bg-light pt-2">
                                            <center><img class="card-img-top" src="{{ url("/img_marzam/".str_pad($product->codigo_marzam,7,'0',STR_PAD_LEFT).".jpg")}}" onerror="this.src='{{ asset('img/dummie.jpg') }}'" alt="Card image cap" style="max-width: 200px; max-height:200px;"></center>
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $product->nombre }}</h5>
                                                <div class="row">
                                                    <div class="col-8 offset-2">
                                                        {!! Form::open(['url' => '/in_shopping_carts', 'method' => 'POST',"class" => " " ]) !!}
                                                        <input type="hidden" name="promotion_id" value="{{$product->id}}">
                                                        <input type="hidden" name="qty" value="1" > 
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">$</span>
                                                            </div>
                                                            <input type="text" readonly class="form-control" value="{{number_format((($product["precio_publico"]{{-- Precio al publico --}}+($product["precio_publico"]*($product["iva"]/100){{-- Agregando IVA --}})+($product["precio_publico"]*($product["ieps"]/100){{-- Agregando IEPS --}})+($product["precio_publico"]*($product["impuesto_3"]/100) {{-- Agregando otros impuestos --}})+($product['precio_publico']*(0.40)){{-- Agregando Porcentaje ganancia --}})/$cambio[0]{{-- Agregando Cambio de moneda(Dolares) --}}),2)}}  USD">
                                                            <div class="input-group-append">
                                                                <button class="btn btn-outline-secondary" type="submit">
                                                                    <i class="price-text-color fa fa-shopping-cart"></i>
                                                                </button>                                                          
                                                            </div>
                                                        </div>
                                                        {!! Form::close() !!}
                                                    </div>
                                                </div>                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                        </div>
                    </div>
                </div>
        </div>   

        <!--ALERTAS-->
            <div class="row">
                <div class="col">
                    @include('feedback')
                </div>
            </div>
        <!--SLIDER_2-->
            <div class="row my-2">
                <div class="col">

                    <div id="carouselExampleSlidesOnly2" class="carousel slide" data-interval="3000" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="row">                       
                                 @for($i = 0; $i < 4; $i++)
                                    <div class="col-12 col-sm-3">
                                        <div class="card bg-light pt-2">
                                            <center><img class="card-img-top" src="{{ url("/img_marzam/".str_pad($products[$i]->codigo_marzam,7,'0',STR_PAD_LEFT).".jpg")}}" onerror="this.src='{{ asset('img/dummie.jpg') }}'" alt="Card image cap" style="max-width: 200px; max-height:200px;"></center>
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $products[$i]->descripcion }}</h5>
                                                <div class="row">
                                                    <div class=" col--8 offset-2">
                                                        {!! Form::open(['url' => '/in_shopping_carts', 'method' => 'POST',"class" => " " ]) !!}
                                                        <input type="hidden" name="promotion_id" value="{{$products[$i]->id}}">
                                                        <input type="hidden" name="qty" value="1" > 
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">$</span>
                                                            </div>
                                                            <input type="text" readonly class="form-control" value="${{number_format((($products[$i]['precio_publico']{{-- Precio al publico --}}+($products[$i]['precio_publico']*($products[$i]['iva']/100){{-- Agregando IVA --}})+($products[$i]['precio_publico']*($products[$i]['ieps']/100){{-- Agregando IEPS --}})+($products[$i]['precio_publico']*($products[$i]['impuesto_3']/100) {{-- Agregando otros impuestos --}})+($products[$i]['precio_publico']*(0.40)){{-- Agregando Porcentaje ganancia --}})/$cambio[0]{{-- Agregando Cambio de moneda(Dolares) --}}),2)}}  USD">
                                                            <div class="input-group-append">
                                                                <button class="btn btn-outline-secondary" type="submit">
                                                                    <i class="price-text-color fa fa-shopping-cart"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        {!! Form::close() !!}
                                                    </div>
                                                </div>                                                
                                            </div>
                                        </div>
                                    </div>
                                @endfor
                                </div>
                            </div>

                            <div class="carousel-item">
                                <div class="row">                       
                                 @for($i = 4; $i < 8; $i++)
                                    <div class="col-12 col-sm-3">
                                        <div class="card bg-light pt-2">
                                            <center><img class="card-img-top" src="{{ url("/img_marzam/".str_pad($products[$i]->codigo_marzam,7,'0',STR_PAD_LEFT).".jpg")}}" onerror="this.src='{{ asset('img/dummie.jpg') }}'" alt="Card image cap" style="max-width: 200px; max-height:200px;"></center>
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $products[$i]->descripcion }}</h5>
                                                <div class="row">
                                                    <div class="col-8 offset-2">
                                                        {!! Form::open(['url' => '/in_shopping_carts', 'method' => 'POST',"class" => " " ]) !!}
                                                        <input type="hidden" name="promotion_id" value="{{$products[$i]->id}}">
                                                        <input type="hidden" name="qty" value="1" > 
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">$</span>
                                                            </div>
                                                            <input type="text" readonly class="form-control" value="${{number_format((($products[$i]['precio_publico']{{-- Precio al publico --}}+($products[$i]['precio_publico']*($products[$i]['iva']/100){{-- Agregando IVA --}})+($products[$i]['precio_publico']*($products[$i]['ieps']/100){{-- Agregando IEPS --}})+($products[$i]['precio_publico']*($products[$i]['impuesto_3']/100) {{-- Agregando otros impuestos --}})+($products[$i]['precio_publico']*(0.40)){{-- Agregando Porcentaje ganancia --}})/$cambio[0]{{-- Agregando Cambio de moneda(Dolares) --}}),2)}}  USD">
                                                            <div class="input-group-append">
                                                                <button class="btn btn-outline-secondary" type="submit">
                                                                    <i class="price-text-color fa fa-shopping-cart"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        {!! Form::close() !!}
                                                    </div>
                                                </div>                                                
                                            </div>
                                        </div>
                                    </div>
                                @endfor
                                </div>
                            </div>
                        </div>
                    </div> 

                </div>
            </div>
        <!--VER MÁS-->
            <div class="row">
                <div class="col-12">
                    <a href="{{ url('/Products1') }}" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Ver Mas Productos</a>
                </div>
                <div class="col-12">
                    <p class="font-italic">
                        * Precio exclusivo de Tienda en Línea. <br>Puede variar por zona geográfica.
                    </p>
                </div>
            </div> 
        <!--CATEGORIAS-->
        <style>       
            .contenedor{
                position: static !important;
            }
            .sobre_cate{
                position: static !important;
                width: 100% !important;
                height: 100% !important;
            }
            .img_cate:hover{
                opacity: 1.0 !important;
            }
            .texto_sobre_cate{
                position: absolute !important;
                width: 100% !important;
                height: 100% !important;
                z-index: -1 !important;
            }
        </style>
        <div class="row mt-3" style="background: rgba(255, 255, 255, 0.51);">
            <div class="col">
                <h1 class="display-4">Categorias</h1>
                
                <div class="row mb-3">
                    @if(count($categories))
                        @foreach ($categories as $index => $category)
                            <div class="col-12 col-sm-4">
                                <!-- <a href="{{ url('/Products1?category=' . $category->slug) }}"> -->
                                    <div class="contenedor">
                                        <div class="texto_sobre_cate">
                                                <p class="h4">{{$category->description}}</p>
                                        </div>
                                        <div class="sobre_cate">
                                            <img class="img_cate" src="images/gallery/cuadros/category{{$index}}.jpg" style="max-width: 300px;">
                                        </div>
                                        
                                    </div>
                                <!-- </a> -->
                            </div>
                        @endforeach 
                    @else
                        <div class="col-12">
                            <h4>No hay categorías disponibles.</h4>
                        </div>
                        
                    @endif
                </div>
            </div>
           
        </div>
    </div>
    
        <script>
            
        </script> 
@endsection