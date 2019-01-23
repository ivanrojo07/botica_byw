<!DOCTYPE html>

<html lang="{{ config('app.locale') }}">

<head><meta http-equiv="Content-Type" content="text/html; charset=shift_jis">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <title>TuFarmaciaLatina.com</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">
    
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
    
</head>

<body class="landing">
    <div id="page-wrapper">
        <!--NAVEGADOR-->
        <header id="header">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark text-light">
                @if((Auth::check() && Auth::user()->rol == 'normal') || Auth::guest())
                    <a class="navbar-brand" href="/">
                        <img src="{{asset('img/logo_rxlatinmed.jpg')}}" height="60px">
                    </a>
                    @endif
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    @if( Auth::check() && Auth::user()->rol == 'admin')
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link product1" href="{{url('/products')}}">Productos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link product1" href="{{url('/admin/sales')}}">Productos Vendidos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link product1" href="{{url('/orders')}}">Ordenes</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link product1" href="{{url('/marzam_orders')}}">Pedidos a Marzam</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link product1" href="{{url('/empaquetado')}}">Empaquetado</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link product1" href="{{url('/tracking')}}">Rastreo</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link product1" href="{{url('/admin/recetas')}}">Recetas</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link product1" href="{{ url('/empleados') }}">Empleados</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link product1" href="{{url('/envios')}}">Tarifas de envios</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/facturas') }}" class="nav-link product1">Facturas</a>
                            </li>
                            
                            <!--log-->
                            <li class="nav-item dropleft">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{url('user')}}">Mi perfil</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Cerrar Sesion
                                    </a>
                                </div>
                            </li>
                        </ul>
                    @elseif (Auth::check() && Auth::user()->rol == 'emple')
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link product1" href="{{url('/products')}}">Productos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link product1" href="{{url('/orders')}}">Ordenes</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link product1" href="{{url('/marzam_orders')}}">Pedidos a Marzam</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link product1" href="{{url('/empaquetado')}}">Empaquetado</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link product1" href="{{url('/tracking')}}">Rastreo</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link product1" href="{{url('/admin/recetas')}}">Recetas</a>
                            </li>
                            <!--log-->
                            <li class="nav-item dropleft">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{url('user')}}">Mi perfil</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Cerrar Sesion
                                    </a>
                                </div>
                            </li>
                        </ul>
                    @elseif (Auth::check() && Auth::user()->rol == 'normal')
                        {!! Form::open(['url' => '/Products1', 'method' => 'GET', 'class' => 'form-inline my-2 my-lg-0']) !!}
                            {!! Form::text ('title', null, ['id'=> 'title', 'class' => 'form-control mr-sm-2', 'placeholder' => 'buscar tu medicamento'])!!}
                        <button type="submit" class="btn btn-outline-success my-2 mx-2" id="search" aria-hidden="true">Buscar</button>
                        {!! Form::close() !!}
                        <a id="carrito" href="{{url('/carrito')}}"><i class="fa fa-cart-plus blue" aria-hidden="true"></i>
                        {{$productsCount}}</a>
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link product1" href="{{url('/promotion')}}">Promociones</a> 
                            </li>
                            <li class="nav-item">
                                <a class="nav-link product1" href="{{url('/nosotros')}}">Nosotros</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link product1" href="{{url('/Products1')}}">Productos</a>
                            </li>
                            <!--log-->
                            <li class="nav-item dropleft">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{url('user')}}">Mi perfil</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Cerrar Sesion
                                    </a>
                                </div>
                            </li>
                        </ul>
                    @elseif (Auth::guest())
                        {!! Form::open(['url' => '/Products1', 'method' => 'GET', 'class' => 'form-inline my-2 my-lg-0']) !!}
                            {!! Form::text ('title', null, ['id'=> 'title', 'class' => 'form-control mr-sm-2', 'placeholder' => 'buscar tu medicamento'])!!}
                        <button type="submit" class="btn btn-outline-success my-2 mx-1" id="search" aria-hidden="true">Buscar</button>
                        {!! Form::close() !!}
                        <a id="carrito" href="{{url('/carrito')}}"><i class="fa fa-cart-plus blue" aria-hidden="true"></i>
                        {{$productsCount}}</a>
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link product1" href="{{url('/promotion')}}">Promociones</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link product1" href="{{url('/nosotros')}}">Nosotros</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link product1" href="{{url('/Products1')}}">Productos</a> 
                            </li>
                            <li class="nav-item mb-1 mr-1">
                                <a href="{{ route('login') }}">
                                    <button type="button" class="btn btn-primary">Ingresar</button>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="button special" href="{{ route('register') }}">
                                    <button type="button" class="btn btn-secondary">Registrate</button>
                                </a>
                            </li>
                        </ul>                    
                    @endif
                </div>
            </nav>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </header>
        <div class="row">
            <div class="offset-sm-3 col-sm-3">
                <div class="compras1 list-group" id="compras1" style="display:none; z-index: 1900; position: absolute;">
                    @if ($productsCount != 0)
                    <li class="list-group-item"><strong>EN TU CARRITO:</strong></li>
                    @else
                        {{-- false expr --}}
                    @endif
                    @foreach ($shopping_products as $element => $producto)
                        {{-- expr --}}
                        <li class="list-group-item">
                            <h5>
                                <img class="img-circle" src="{{ url("/img_marzam/".str_pad($producto->codigo_marzam,7,'0',STR_PAD_LEFT).".jpg")}}" onerror="this.src='{{ asset('img/12.jpg') }}'" style="display: inline-block;" height="42" width="42">
                            {{ $producto->descripcion}} 
                            </h5>
                        </li>
                    @endforeach
                    @foreach ($shopping_promotions as $element => $producto)
                        {{-- expr --}}
                        <li class="list-group-item">
                            <h5>
                                @if($producto->extension)
                                    <img class="img-circle" src="{{ url("/img_prod/$producto->id.$producto->extension")}}"  style="display: inline-block;" height="42" width="42">
                                @else
                                    <img class="img-circle" src="{{ asset('img/12.jpg') }}" style="display: inline-block;" height="42" width="42">
                                @endif
                                    OFERTA: {{ $producto->nombre}} 
                            </h5>
                            </li>
                    @endforeach
                </div>
            </div>
        </div>
                


        <!--CONTENIDO-->
        @yield('content')

    </div>
        <!--FOOTER-->
        <footer id="footer" class="p-0">
            
                <div class="row bg-dark text-white p-4">
                    <div class="col-11 col-sm-4">
                        <a href="{{url('/faq')}}" class="mx-auto"><p class="font-weight-bold">Preguntas Frecuentes</p></a>
                        <a href="{{url('/nosotros')}}" class=""><p class="font-weight-bold">Nosotros</p></a>
                        <a href="{{url('/privacidad')}}" class=""><p class="font-weight-bold">Aviso de Privacidad</p></a> 
                        <a href="{{url('/contact')}}" class=""><p class="font-weight-bold">Contáctanos</p></a>
                    </div>
                    <div class="col-11 col-sm-4">
                        <ul>
                            <dd><h3>CONTÁCTANOS</h3></dd>
                            <dd><span>01 800 269 980 1</span></dd>
                            <dd><span>info@tufarmacialatina.com</span></dd>
                        </ul>
                        {{-- <ul>
                            <dd><img src="{{ asset('img/pp.png') }}" alt=""></dd>
                        </ul> --}}
                    </div>
                    <div class="col-11 col-sm-4">
                        <ul>
                            <dd>© {{date('Y')}} RX LATIN MED</dd>
                            <dd>All rights reserved.</dd>
                        </ul>
                    </div>
                </div>
        </footer>
    
</head>

<!-- Scripts -->



    
<!-- Scripts -->


<script src="{{ url('/js/editable.js') }}"></script>
<script src="{{ url('js/jquery-1.12.4.min.js') }}"></script>
<script src="{{ url('js/jquery.min.js') }}"></script>
<script src="{{ url('js/jquery-ui.js') }}"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
{{-- no sirve xD --}}
{{-- <script src="{{ url('/js/app.js') }}"></script> --}}

   <script>
   $(document).ready(function(){
     $( "#title" ).autocomplete({
        // alert(products);
          source: function(request, response) {
        $.ajax({
            url: "/productslist",
            type: "GET",
            dataType:"json",
            data:{products: this.term},
            success: function (datos){
                 response( $.map( datos, function( item ) {
                return {label: item.descripcion, value: item.descripcion, url: item.id};}));
            }
        });
        },
          
          select: function(event, ui){
            $("#title").val(ui.item.label);
            window.location.href = "products/"+ui.item.url;
            
            
          }
        });
    });
    $(document).ready(function(){
        $("#carrito").hover(function() {
            $("#compras1").show();
            }, function(){
            $("#compras1").hide();                            
        });
    });
  </script>

   @yield('scripts')
</body>
</html>

