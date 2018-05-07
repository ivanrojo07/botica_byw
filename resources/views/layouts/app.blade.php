<!DOCTYPE html>

<html lang="{{ config('app.locale') }}">

<head><meta http-equiv="Content-Type" content="text/html; charset=shift_jis">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>TuFarmaciaLatina.com</title>
    <!-- Styles -->
    <!--Import materialize.css-->
    {{-- <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/> --}}
    <!--Let browser know website is optimized for mobile-->
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/icon?family=Material+Icons">
    {{-- <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> --}}
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/responsive.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}"/>
    <link href="js/plugins/owl-carousel/owl.carousel.css" rel="stylesheet">
    <link href="js/plugins/owl-carousel/owl.theme.css" rel="stylesheet">
    <link href="js/plugins/magnific-popup/magnific-popup.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/fileinput.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mdb.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sweetalert.css') }}">
   {{--  <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/> --}}
    <!--load everything-->
    <script src="{{ asset('js/fontawesome-all.js') }}"></script>
    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
</head>

<body class="landing">
<div id="page-wrapper">
    <header id="header">

                <nav class="navbar navbar-expand-lg navbar-dark bg-dark text-light">
                    @if((Auth::check() && Auth::user()->rol == 'normal') || Auth::guest())
                        <a class="navbar-brand" href="#">
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
                                    <a class="nav-link product1" href="{{url('/orders')}}">Ordenes</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link product1" href="{{ url('/empleados') }}">Empleados</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link product1" href="{{url('/envios')}}">Tarifas de envios</a>
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
                                    <a class="nav-link product1" href="{{url('/orders')}}">Ordenes</a>
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
                            <button type="submit" class="btn btn-outline-success my-2 my-sm-0" id="search" aria-hidden="true">Buscar</button>

                            {!! Form::close() !!}

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
                                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
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
                            <button type="submit" class="btn btn-outline-success my-2 my-sm-0" id="search" aria-hidden="true">Buscar</button>

                            {!! Form::close() !!}

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
                                <li class="nav-item">
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
    <div class="compras1" id="compras1">
        @if ($productsCount != 0)
            {{-- true expr --}}
        <div style="margin-left: 155px"><strong>EN TU CARRITO:</strong></div>
        @else
            {{-- false expr --}}
        @endif
        @foreach ($shopping_products as $element => $producto)
            {{-- expr --}}
        <div class="container">
            <h5>
                <img class="img-circle" src="{{ url("/img_marzam/".str_pad($producto->codigo_marzam,7,'0',STR_PAD_LEFT).".jpg")}}" onerror="this.src='{{ asset('img/12.jpg') }}'" style="display: inline-block;" height="42" width="42">
             {{ $producto->descripcion}} 
            </h5></div>
        @endforeach
        @foreach ($shopping_promotions as $element => $producto)
            {{-- expr --}}
        <div class="container">
            <h5>
            @if($producto->extension)

                <img class="img-circle" src="{{ url("/img_prod/$producto->id.$producto->extension")}}"  style="display: inline-block;" height="42" width="42">
            @else

                <img class="img-circle" src="{{ asset('img/12.jpg') }}" style="display: inline-block;" height="42" width="42">
            @endif

            OFERTA: {{ $producto->nombre}} 
            </h5></div>
        @endforeach
    </div>
                

    <span class="ir-arriba">
        <i class="fas fa-arrow-up"></i>
    </span>
        
    @yield('content')
         



    <!--*****************************FOOTER-->

    <footer id="footer" class="p-0">
            <div class="row bg-dark">
                <div class="col-12 col-sm-4">
                    <a href="{{url('/faq')}}" class=""><span class="label">Preguntas Frecuentes</span></a><br>
                    <a href="{{url('/nosotros')}}" class=""><span class="label">Nosotros</span></a><br>
                    <a href="{{url('/privacidad')}}" class=""><span class="label">Aviso de Privacidad</span></a><br>
                    <a href="{{url('/contact')}}" class=""><span class="label">Contactanos</span></a>
                </div>
                <div class="col-12 col-sm-4">
                    <ul>
                        <li><h3>CONTÁCTANOS</h3></li><br>
                        <li><span>01 800 269 980 1</span></li>
                        <li><span>info@tufarmacialatina.com</span></li>
                    </ul>
                    <ul>
                        <li><img src="{{ asset('img/pp.png') }}" alt=""></li>
                    </ul>
                </div>
                <div class="col-12 col-sm-4">
                    <ul>
                        <li>&copy; Untitled. All rights reserved.</li>
                        <li>© 2017 RX LATIN MED</li>
                    </ul>
                </div>
            </div>
    </footer>
</div>

<!-- Scripts -->



<script src="{{ url('js/jquery.min.js') }}"></script>
<script src="{{ url('js/jquery-1.12.4.min.js') }}"></script>
<script src="{{ url('js/jquery-ui.js') }}"></script>

{{-- Import jQuery before materialize.js --}}
 <script type="text/javascript" src="{{ url('js/jquery-3.1.1.min.js') }}"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>

<script src="{{ url('/js/editable.js') }}"></script>

<script src="{{ url('/js/app.js') }}"></script>

<script>

   $(document).ready(function(){
     $( "#title" ).autocomplete({
        // alert(products);
          source: function(request, response) {
        $.ajax({
            url: "{{url('/productslist')}}",
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
            window.location.href = "/products/"+ui.item.url;
            
            
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
    // function productos(){
    //     console.log({{$shopping_products}});
    // }

        
    // var availableTags = [
    //   "ActionScript",
    //   "AppleScript",
    //   "Asp",
    //   "BASIC",
    //   "C",
    //   "C++",
    //   "Clojure",
    //   "COBOL",
    //   "ColdFusion",
    //   "Erlang",
    //   "Fortran",
    //   "Groovy",
    //   "Haskell",
    //   "Java",
    //   "JavaScript",
    //   "Lisp",
    //   "Perl",
    //   "PHP",
    //   "Python",
    //   "Ruby",
    //   "Scala",
    //   "Scheme"
    // ];
    // console.log(products);
  </script>



@yield('scripts')

</body>

</html>

