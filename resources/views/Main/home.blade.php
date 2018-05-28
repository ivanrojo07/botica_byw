@extends('layouts.app')
@section('title', 'Productos Facilito')
@section('content')
    <!-- Banner -->

    <div class="container-fluid mt-0 pt-3 background-image" style="background-image:{{url('img/bg-banner.jpg')}}">
        <div class="row">
        <!--JUMBO-->
            <div class="col col-sm-7">
                <div class="jumbotron">
                    <h2>TuFarmaciaLatina.com</h2>
                    <p class="lead">Enviamos a toda Latinoamerica Incluyendo a VENEZUELA Y CUBA.{{-- {{ dd($shopping_products)}} --}}</p>
                    <hr class="my-4">
                    <a href="{{ url('/seguimiento')}}"><p>¡Dale Seguimiento a tu pedido!</p></a>
                    <p class="lead">
                        <a class="btn btn-primary btn-lg" href="{{ url('/Products1')}}" role="button">¡COMPRAR!</a>
                    </p>
                </div>
            </div>
        <!--SLIDER_1-->
            <div class="col d-none d-sm-block">
                <div id="carouselExampleSlidesOnly" class="carousel slide" data-interval="2300" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                        </div>
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
        <!--CATEGORÍAS-->
            <div class="row">
                <div class="col">
                    <div class="dropdown">
                        <button class="btn btn-dark btn-lg btn-block dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Categorías
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                @foreach ($categories as $category)
                                    {{-- expr --}}
                                    <a href="{{ url('/Products1?category=' . $category->slug) }}" class="dropdown-item" >{{$category->description}}</a>
                                @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                
                                <div id="carousel-example" class="carousel slide hidden-xs" data-ride="carousel">
                                <!-- Wrapper for slides -->
                                <div class="carousel-inner">
                                    <div class="item active">
                                        <div class="row">
                                            @foreach ($products as $product)
                                                {{-- expr --}}
                                            <div class="col-sm-3">
                                                <div class="col-item">
                                                    <div class="photo">
                                                        <img class="img-responsive" src="{{ url("/img_marzam/".str_pad($product->codigo_marzam,7,'0',STR_PAD_LEFT).".jpg")}}" onerror="this.src='{{ asset('img/dummie.jpg') }}'"  alt="a" width="350px" height="260px">
                                                    </div>
                                                    <div class="info">
                                                        <div class="row">
                                                            <div class="price ">
                                                                <h5 class="price-text-color">
                                                                    {{$product->descripcion}}</h5>
                                                                <h5 class="price-text-color">
                                                                    @if(isset($promotion) && $promotion)
                                                                        $ {{$product->promotion_pricing}} usd
                                                                    @else
                                                                        $  {{number_format((($product["precio_publico"]{{-- Precio al publico --}}+($product["precio_publico"]*($product["iva"]/100){{-- Agregando IVA --}})+($product["precio_publico"]*($product["ieps"]/100){{-- Agregando IEPS --}})+($product["precio_publico"]*($product["impuesto_3"]/100) {{-- Agregando otros impuestos --}})+($product['precio_publico']*(0.40)){{-- Agregando Porcentaje ganancia --}})/$cambio[0]{{-- Agregando Cambio de moneda(Dolares) --}}),2)}}  USD
                                                                    @endif</h5>
                                                            </div>
                                                        </div>
                                                        <div class="clearfix">
                                                                {!! Form::open(['url' => '/in_shopping_carts', 'method' => 'POST' ]) !!}
                                                                <input type="hidden" name="product_id" value="{{$product->id}}">
                                                                <input type="hidden" name="qty" value="1" >
                                                            <p class="btn">
                                                                        <i class="price-text-color fa fa-shopping-cart"></i><button type="submit" class="btn btn-link hidden-sm">Agregar al carrito</button>
                                                            </p>
                                                                {!! Form::close() !!}
                                                        </div>
                                                        <div class="clearfix">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                </div>
                            

                </div>
            </div>
    </div>

    

    <!-- Four -->

    <section id="four" class="wrapper style1 special fade-up">

        <div id="productos" class="container">
            <header class="major">

                <h2 class="grey">Categorias</h2>

                <p class="grey">

                    * Precio exclusivo de Tienda en Línea.

                    Puede variar por zona geográfica.

                </p>

            </header>
            <div class="main-container container text-center">
                <!-- Gallery Grid Starts -->
            <ul class="row list-unstyled" id="gallery-grid">
                @if(count($categories))
                @foreach ($categories as $index => $category)
                    {{-- expr --}}
            <!-- Gallery Item #1 Starts -->
                <li class="col-md-4 col-sm-6 col-xs-12 gallery-grid-item" >
                    <a href="{{ url('/Products1?category=' . $category->slug) }}">
                    <div class="hover-content">
                        <img src="images/gallery/cuadros/category{{$index}}.jpg" alt="Gallery Image 1" class="img-responsive img-center animation-1">
                        <div class="overlay animation text-lite-color">
                            <h6 class="text-uppercase animation-1">{{$category->description}}</h6>
                            <p class="animation-1">{{$category->description}}</p>                                     
                        </div>
                    </div>
                    </a>
                </li>    
            <!-- Gallery Item #1 Ends -->
                @endforeach 
            </ul>
        <!-- Gallery Grid Ends -->
            @else
                <div class="alert alert-warning">
                    No hay categorías disponibles.
                </div>
            @endif
            </div>
            <footer class="major">
                <ul class="actions">
                    <li><a href="{{ url('/Products1') }}" class="button blue-template1">Ver Mas Productos</a></li>
                </ul>
            </footer>
        </div>
    </section>
    {{-- <!-- One -->
    <section id="one" class="spotlight style1 left">
        <div class="content">
            <header>
                <h2>Servicios</h2>
            </header>
            <p>En TuFarmaciaLatina todos los servicios que ofrecemos cuentan con el respaldo sanitario y la seriedad de
                profesionales de alto nivel, que aporta un valor añadido para prevenir la enfermedad, incrementar su
                nivel de salud y aportar información.</p>
            <ul class="actions">
                <li><a href="{{url('/servicios')}}" class="button">Servicios</a></li>
            </ul>
        </div>
    </section>
    <!-- Two -->
    <section id="two" class="spotlight style2 right">
        <div class="content">
            <header>
                <h2>Servicio de Atención Social</h2>
            </header>
            <p>Parte de nuestro servicio esta destinado a ayudar a las personas que no tengan recursos. Este servicio

                social se trabaja conjuntamente con las Iglesias Cristianas. Algunos productos necesitan la Prescripción

                de su Doctor. No Prescribimos Recetas para Medicinas solo suplimos la venta de la medicina y el envío a

                su familiar en su país.</p>
            <ul class="actions">
                <li><a href="#" class="button">Leer Mas</a></li>
            </ul>
        </div>
    </section>
    <!-- Three -->
    <section id="three" class="spotlight style3 left	">
        <div class="content">
            <header>
                <h2>Entregamos en toda América Latina incluyendo VENEZUELA y CUBA.</h2>
            </header>
            <p> El tiempo de despacho se realizara una vez el pago sea confirmado.En el caso de Cuba usted puede recoger
                su Medicina en Cuba de 5 a 7 días laborables en Provincia Habana en los puntos de recogidas. De 7-10
                días en las provincias del interior. Usted puede optar por ir a recoger su paquete o que se lo entreguen
                en su casa.
            <ul class="actions">
                <li><a href="#" class="button">Envios</a></li>
            </ul>
        </div>
    </section> --}}
@endsection
@section('scripts')
<!--     
    
    <script type="text/javascript" src="{{ url('js/mdb.min.js') }}"></script> -->
@endsection