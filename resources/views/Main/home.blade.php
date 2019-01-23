@extends('layouts.app')
@section('content')
    <!-- Banner -->

    <div class="container-fluid mt-0 pt-3 background-image" {{-- style="    background-color: #424242;
    background: url(../img/bg-banner.jpg)no-repeat fixed;
    background-size: auto auto;
    margin-top: 0px !important;
    background-position: top center;
    min-height: 100vh;
    position: relative;
    text-align: center;
    /* background-repeat: no-repeat; */
    background-color: #ABB5C1;
    z-index: 21;
    box-shadow: 0 .5em 15px 0 rgba(0, 0, 0, 0.7) !important;" --}}>

        <div class="row">
            <!--JUMBO-->
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                    <div class="jumbotron" style="background: rgba(255, 255, 255, 0.51);">
                        <h2 class="titulo">TuFarmaciaLatina.com</h2>
                        <p class="lead"><strong> Entregamos tus medicinas a tus seres queridos.</strong></p>
                        <hr class="my-4">
                        {{-- <a href="{{ url('/seguimiento')}}"><p><strong>¡Dale Seguimiento a tu pedido!</strong></p></a> --}}
                        <p class="lead">
                            <a class="btn btn-primary btn-lg" href="{{ url('/Products1')}}" role="button">¡COMPRAR!</a>
                        </p>
                    </div>
                </div>
            <!--SLIDER_1-->
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 d-none d-sm-block">
                    <div id="carouselExampleSlidesOnly" class="carousel slide" data-interval="2300" data-ride="carousel">
                        <div class="carousel-inner">
                            @foreach($products_slider1 as $producto1)
                                @if ($loop->first)
                                    <div class="carousel-item active">
                                @else
                                    <div class="carousel-item">
                                @endif
                                <div class="row no-gutters">
                                    <div class="col-xl-8 col-lg-10 col-md-12 col-sm-12 offset-xl-2">
                                        <div class="card bg-light pt-2">
                                            <center><img class="card-img-top" src="{{ url("/img_marzam/".str_pad($producto1->codigo_marzam,7,'0',STR_PAD_LEFT).".jpg")}}" onerror="this.src='{{ asset('img/dummie.jpg') }}'" alt="Card image cap" style="max-width: 200px; max-height:200px;"></center>
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $producto1->nombre }}</h5>
                                                <div class="row">
                                                    <div class="col-xl-10 offset-xl-1 col-lg-10 offset-lg-1 col-md-12 col-sm-12">
                                                        {!! Form::open(['url' => '/in_shopping_carts', 'method' => 'POST',"class" => " " ]) !!}
                                                        <input type="hidden" name="promotion_id" value="{{$producto1->id}}">
                                                        <input type="hidden" name="qty" value="1" > 
                                                        <div class="input-group mb-auto">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">$</span>
                                                            </div>
                                                            <input type="text" readonly class="form-control text-center" value="{{number_format((($producto1["precio_publico"]{{-- Precio al publico --}}+($producto1["precio_publico"]*($producto1["iva"]/100){{-- Agregando IVA --}})+($producto1["precio_publico"]*($producto1["ieps"]/100){{-- Agregando IEPS --}})+($producto1["precio_publico"]*($producto1["impuesto_3"]/100) {{-- Agregando otros impuestos --}})+($producto1['precio_publico']*(0.40)){{-- Agregando Porcentaje ganancia --}})/$cambio[0]{{-- Agregando Cambio de moneda(Dolares) --}}),2)}}">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">USD</span>
                                                            </div>
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
                                    <div class="col-xl-8 col-lg-10 col-md-12 col-sm-12 offset-xl-2">
                                        <div class="card bg-light pt-2">
                                            <center><img class="card-img-top" src="{{ url("/img_marzam/".str_pad($product->codigo_marzam,7,'0',STR_PAD_LEFT).".jpg")}}" onerror="this.src='{{ asset('img/dummie.jpg') }}'" alt="Card image cap" style="max-width: 200px; max-height:200px;"></center>
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $product->nombre }}</h5>
                                                <div class="row">
                                                    <div class="col-xl-10 offset-xl-1 col-lg-10 offset-lg-1 col-md-12 col-sm-12">
                                                        {!! Form::open(['url' => '/in_shopping_carts', 'method' => 'POST',"class" => " " ]) !!}
                                                        <input type="hidden" name="promotion_id" value="{{$product->id}}">
                                                        <input type="hidden" name="qty" value="1" > 
                                                        <div class="input-group mb-auto">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">$</span>
                                                            </div>
                                                            <input type="text" readonly class="form-control text-center" value="{{number_format((($product["precio_publico"]{{-- Precio al publico --}}+($product["precio_publico"]*($product["iva"]/100){{-- Agregando IVA --}})+($product["precio_publico"]*($product["ieps"]/100){{-- Agregando IEPS --}})+($product["precio_publico"]*($product["impuesto_3"]/100) {{-- Agregando otros impuestos --}})+($product['precio_publico']*(0.40)){{-- Agregando Porcentaje ganancia --}})/$cambio[0]{{-- Agregando Cambio de moneda(Dolares) --}}),2)}}">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">USD</span>
                                                            </div>
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
                                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 pt-2 pb-2">
                                        <div class="card bg-light pt-2">
                                            <center><img class="card-img-top" src="{{ url("/img_marzam/".str_pad($products[$i]->codigo_marzam,7,'0',STR_PAD_LEFT).".jpg")}}" onerror="this.src='{{ asset('img/dummie.jpg') }}'" alt="Card image cap" style="max-width: 200px; max-height:200px;"></center>
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $products[$i]->descripcion }}</h5>
                                                <div class="row">
                                                    <div class="col-xl-12  col-lg-12  col-md-12 col-sm-12">
                                                        {!! Form::open(['url' => '/in_shopping_carts', 'method' => 'POST',"class" => " " ]) !!}
                                                        <input type="hidden" name="product_id" value="{{$products[$i]->id}}">
                                                        <input type="hidden" name="qty" value="1" > 
                                                        <div class="input-group mb-auto">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">$</span>
                                                            </div>
                                                            <input type="text" readonly class="form-control text-center" value="{{number_format((($products[$i]['precio_publico']{{-- Precio al publico --}}+($products[$i]['precio_publico']*($products[$i]['iva']/100){{-- Agregando IVA --}})+($products[$i]['precio_publico']*($products[$i]['ieps']/100){{-- Agregando IEPS --}})+($products[$i]['precio_publico']*($products[$i]['impuesto_3']/100) {{-- Agregando otros impuestos --}})+($products[$i]['precio_publico']*(0.40)){{-- Agregando Porcentaje ganancia --}})/$cambio[0]{{-- Agregando Cambio de moneda(Dolares) --}}),2)}}">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">USD</span>
                                                            </div>
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
                                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 pt-2 pb-2">
                                        <div class="card bg-light pt-2">
                                            <center><img class="card-img-top" src="{{ url("/img_marzam/".str_pad($products[$i]->codigo_marzam,7,'0',STR_PAD_LEFT).".jpg")}}" onerror="this.src='{{ asset('img/dummie.jpg') }}'" alt="Card image cap" style="max-width: 200px; max-height:200px;"></center>
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $products[$i]->descripcion }}</h5>
                                                <div class="row">
                                                    <div class="col-12">
                                                        {!! Form::open(['url' => '/in_shopping_carts', 'method' => 'POST',"class" => " " ]) !!}
                                                        <input type="hidden" name="product_id" value="{{$products[$i]->id}}">
                                                        <input type="hidden" name="qty" value="1" > 
                                                        <div class="input-group mb-auto">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">$</span>
                                                            </div>
                                                            <input type="text" readonly class="form-control text-center" value="${{number_format((($products[$i]['precio_publico']{{-- Precio al publico --}}+($products[$i]['precio_publico']*($products[$i]['iva']/100){{-- Agregando IVA --}})+($products[$i]['precio_publico']*($products[$i]['ieps']/100){{-- Agregando IEPS --}})+($products[$i]['precio_publico']*($products[$i]['impuesto_3']/100) {{-- Agregando otros impuestos --}})+($products[$i]['precio_publico']*(0.40)){{-- Agregando Porcentaje ganancia --}})/$cambio[0]{{-- Agregando Cambio de moneda(Dolares) --}}),2)}}">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">USD</span>
                                                            </div>
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
                   *Precio exclusivo de Tienda en Línea. <br>Puede variar por zona geográfica.
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
        <div class="container mt-3" style="padding-top:15px; padding-bottom:15px;background: rgba(255, 255, 255, 0.51);">
            
                
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
              <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" style="background-color: black;" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" style="background-color: black;" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" style="background-color: black;" data-slide-to="2"></li>
                <li data-target="#carouselExampleIndicators" style="background-color: black;" data-slide-to="3"></li>
                <li data-target="#carouselExampleIndicators" style="background-color: black;" data-slide-to="4"></li>
              </ol>
              <div class="carousel-inner">
                <div class="carousel-item active">
                    <a href="{{ url('/Products1?category=ET') }}">
                        
                      <img class="d-block w-100 h-100" height="825px" width="354px" src="{{ asset('/images/gallery/cuadros/patente.jpg') }}" alt="First slide">
                      <div class="carousel-caption d-none d-md-block" style="background: rgba(255, 255, 255, 0.85);">
                        <h3 style="color:black!important;" >Medicamentos de patentes</h3>
                        <p style="color:black!important;"> surgen de una investigación profunda que realiza un laboratorio con la intención de sanar un padecimiento específico, por este descubrimiento se le otorga la patente, la cual tiene un determinado período de duración, es decir, el inventor tiene la exclusividad de producción</p>
                      </div>
                    </a>
                </div>
                <div class="carousel-item">
                    <a href="{{ url('/Products1?category=OT') }}">
                        
                      <img class="d-block w-100 h-100" height="825px" width="354px" src="{{ asset('/images/gallery/cuadros/category22.jpg') }}" alt="Second slide">
                      <div class="carousel-caption d-none d-md-block" style="background: rgba(255, 255, 255, 0.85);">
                        <h3 style="color:black!important;" >Medicamentos generales</h3>
                        <p style="color:black!important;">  Producen los mismos efectos que su contraparte de patente, ya que poseen el mismo principio activo.</p>
                      </div>
                    </a>
                </div>
                <div class="carousel-item">
                    <a href="{{ url('/Products1?category=MC') }}">
                        <img class="d-block w-100 h-100" height="825px" width="354px" src="{{ asset('/images/gallery/cuadros/materialdecuracion.jpg') }}" alt="Second slide">
                          <div class="carousel-caption d-none d-md-block" style="background: rgba(255, 255, 255, 0.85);">
                            <h3 style="color:black!important;" >Material de curación</h3>
                            <p style="color:black!important;">  Agrupa los insumos como dispositivos, materiales y substancias, de un solo uso que se emplean en la atención médica, quirúrgica, procedimientos de exploración, diagnóstico y tratamiento.</p>
                          </div>
                    </a>
                 
                </div>
                <div class="carousel-item">
                    <a href="{{ url('/Products1?category=PF') }}">
                        <img class="d-block w-100 h-100" height="825px" width="354px" src="{{ asset('/images/gallery/cuadros/perfumeria.jpg') }}" alt="Second slide">
                          <div class="carousel-caption d-none d-md-block" style="background: rgba(255, 255, 255, 0.85);">
                            <h3 style="color:black!important;" >Perfumería</h3>
                            <p style="color:black!important;">  Perfumes, lociones y todo el cuidado personal.</p>
                          </div>
                    </a>
                 
                </div>
                <div class="carousel-item">
                    <a href="{{ url('/Products1?category=VA') }}">
                        <img class="d-block w-100 h-100" height="825px" width="354px" src="{{ asset('/images/gallery/cuadros/varios.jpg') }}" alt="Second slide">
                          <div class="carousel-caption d-none d-md-block" style="background: rgba(255, 255, 255, 0.85);">
                            <h3 style="color:black!important;" >Varios</h3>
                            <p style="color:black!important;">  Toda la farmacia a tu alcance.</p>
                          </div>
                    </a>
                 
                </div>
              </div>
              <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true" ></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>

        </div>
           
        </div>
    </div>
    
        <script>
            
        </script> 
@endsection