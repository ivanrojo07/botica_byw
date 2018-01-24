@extends('layouts.app')



@section('title', 'Productos Facilito')



@section('content')

    <!-- Banner -->

    <div id="index-header">

        <section id="banner">

            <div class="content">

                    <div style="margin-top: 380px !important;">
                        <div class="container">
                            <nav class="navbar navbar-inverse navbar-xs" style="background: #1c1d26;" role="navigation">
                          <!-- Brand and toggle get grouped for better mobile display -->
                          <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                              <span class="sr-only">Toggle navigation</span>
                              <span class="icon-bar"></span>
                              <span class="icon-bar"></span>
                              <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="#productos"><b>Categorías</b></a>
                          </div>

                          <!-- Collect the nav links, forms, and other content for toggling -->
                          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav">
                                <?php $count = 0; ?>
                              @foreach ($categories as $category)
                                  {{-- expr --}}
                                  <?php if($count == 8) break; ?>
                                  <li><a href="{{ url('/Products1?category=' . $category->slug) }}" title="{{$category->description}}" style="font-size: 12px">{{$category->title}}</a></li>
                                    <?php $count++; ?>
                              @endforeach
                                </ul>
                              </li>
                            </ul>
                          </div><!-- /.navbar-collapse -->
                        </nav>
                        </div>
                    </div>
                <header>
           
                    <div class="info-header" style="margin-top: -410px !important">
                        <h2 class="satisfic-font">TuFarmaciaLatina.com</h2>

                        <p>Enviamos a toda Latinoamerica Incluyendo a VENEZUELA Y CUBA.</p>

                        <p class="satisfic-font"><a href="{{ url('/seguimiento')}}">¡Dale Seguimiento a tu pedido!</a></p>
                        <p class="statisfic-font"><a href="{{ url('/Products1')}}">¡COMPRAR!</a>
                        

                    </div>



                    <div id="slider">

                        <ul>

                            @foreach($products_slider as $product)

                                <li>

                                    

                                    <div class="slider-container">

    @if($product->extension)

        <img class="bt1" src="{{ url("/img_prod/$product->id.$product->extension")}}" class="product_avatar">

    @else

        <img class="bt1" src="{{ asset('img/12.jpg') }}" class="product_avatar">

    @endif

    

        <h4> {{ $product->title }}

                                        </h4>

                                         <p class="costo orangep">

                                            {{$product->pricing}} USD

                                        </p>

                                        <a class="btn btn-primary" href="{{ url('/Products1')}}">Ver Promociones</a>



                                       



                                    </div>

                                </li>

                            @endforeach

                           

                        </ul>

                    </div>

                </header>

                <span class="image"></span>

            </div>





        </section>

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
                    <div class="hover-content">
                        <img src="images/gallery/cuadros/category{{$index}}.jpg" alt="Gallery Image 1" class="img-responsive img-center animation-1">
                        <div class="overlay animation text-lite-color">
                            <h6 class="text-uppercase animation-1">{{$category->description}}</h6>
                            <p class="animation-1">{{$category->title}}</p>                                     
                        </div>
                    </div>
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

            

            @if(count($categories))

                <div class="box alt">

                    <div class="row uniform category">
                        <?php $count = 0; ?>
                        @foreach($categories as $index => $category)
                            <?php if($count == 6) break; ?>
                            <section

                                    class="{{ ((($index+1)%3) == 0) ? '4u$ 6u(medium) 12u$(xsmall)' : '4u 6u(medium) 12u$(xsmall)' }}">

                                <a href="{{ url('/Products1?category=' . $category->slug) }}">

                                    <h3 class="grey">

                                        {{ $category->title }}

                                    </h3>

                                    <p class="grey">

                                        {{ $category->description }}

                                    </p>

                                </a>

                            </section>
                            <?php $count++; ?>
                        @endforeach

                    </div>

                </div>

            @else

                <div class="alert alert-warning">

                    No hay categorías disponibles.

                </div>

            @endif





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

    <!--<section class="spotlight style1 top">

    <div class="content">

        <div class="container">

            <div class="">

        <header>

            <h2 class="text-center">Suscríbete para recibir nuestras nuevas ofertas!!</h2>

        </header>



        <ul class="actions actiones">

        <form action="">

            <li><input type="email" placeholder="Agrega tu email"></li>

            <li><input type="submit" class="button" value="Suscríbete"></li>

            </form>



        </ul>

            </div>

        </div>

    </div>

</section>-->



 <!--   <section id="envios" class="spotlight style1 top">

        <div class="content">

            <div class="container ">

                <div class="">

                    <header>

                        <h2 class="text-center">Haz click para envios a: </h2>

                    </header>

                    <ul class="actions">

                        <li class="ven"><a href="https://rxlatinmeds.clickfunnels.com/phone-order-venezuela"

                                           class="button">Venezuela</a>

                        </li>

                        <li class="cuba"><a href="https://rxlatinmeds.clickfunnels.com/phone-order-cuba" class="button">Cuba</a>

                        </li>

                    </ul>

                </div>

            </div>

            <br>

        </div>

    </section>-->






    





@endsection

@section('scripts')
    {{-- expr --}}
    <script src="{{ url('js/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ url('js/jquery-migrate-1.4.1.min.js') }}"></script>
    <script src="{{ url('js/bootstrap.min.js') }}"></script>
    <script src="{{ url('js/plugins/backstretch/jquery.backstretch.min.js') }}"></script>
    <script src="{{ url('js/plugins/shuffle/jquery.shuffle.modernizr.min.js') }}"></script>
    <script src="{{ url('js/plugins/owl-carousel/owl.carousel.js') }}"></script>
    <script src="{{ url('js/plugins/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ url('js/custom.js') }}"></script>

@endsection
