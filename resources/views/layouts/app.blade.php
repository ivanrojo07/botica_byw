<!DOCTYPE html>

<html lang="{{ config('app.locale') }}">

<head><meta http-equiv="Content-Type" content="text/html; charset=shift_jis">

    

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>



    <!-- CSRF Token -->

    <meta name="csrf-token" content="{{ csrf_token() }}">



    <title>TuFarmaciaLatina.com</title>



    <!-- Styles -->
    <!-- ByW -->
        <link href="css/byw.min.css" rel="stylesheet">

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
    <link href="css/style.css" rel="stylesheet">
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


</head>

<body class="landing">



<div id="page-wrapper">

    <header id="header" style="position: fixed !important">

        @if(Auth::check() && (Auth::user()->rol == 'admin' || Auth::user()->rol == 'emple'))
        @else

            <h1 id="logo"><a href="{{ url('/') }}"><img src="{{ asset('img/logo_rxlatinmed.jpg') }}" height="60px"></a></h1>
        
        @endif

        <nav id="nav">

            <ul style="font-size: 12px;">

                @if(Auth::check() && (Auth::user()->rol == 'admin' || Auth::user()->rol == 'emple'))
                @else
                <li>





                    {!! Form::open(['url' => '/Products1', 'method' => 'GET', 'class' => 'navbar-form pull-left']) !!}

                    <div class="form-group">

                        {!! Form::text ('title', null, ['id'=> 'title', 'class' => 'form-control btn-search autocomplete', 'placeholder' => 'buscar tu medicamento'])!!}

                    </div>

                    <button type="submit" class="btn btn-default btn-search2" id="search" aria-hidden="true">Buscar

                    </button>



                    {!! Form::close() !!}

                    <a id="carrito" href="{{url('/carrito')}}"><i class="fa fa-cart-plus blue" aria-hidden="true"></i>

                        {{$productsCount}}</a>
                </li>
            
                @endif

                <li>
                 @if(Request::is('/'))

                    @if(Auth::check() && Auth::user()->rol == 'admin')


                        <a class="product1" href="{{url('/products')}}">Productos</a>
                    @elseif(Auth::check() && Auth::user()->rol == 'emple')
                    @else


                        <a class="product1" href="#productos">Productos</a>

                    @endif


                 @else

                    @if(Auth::check() && Auth::user()->rol == 'admin')


                        <a class="product1" href="{{url('/products')}}">Productos</a>
                    @elseif(Auth::check() && Auth::user()->rol == 'emple')

                    @else

                        <a class="product1" href="{{url('/Products1')}}">Productos</a>
                    

                    @endif


                 @endif                        

                </li>


                @if(Auth::check() && Auth::user()->rol == 'normal')
                @endif



                @if(Auth::check() && Auth::user()->rol == 'admin')

                    <li>

                        <a class="product1" href="{{url('/admin/sales')}}">Productos Vendidos</a>

                    </li>
                @elseif(Auth::check() && Auth::user()->rol == 'emple')
                    

                @else

                    <li>

                        <a class="product1" href="{{url('/promotion')}}">Promociones</a>

                    </li>

                    <li>

                            <a class="product1" href="{{url('/nosotros')}}">Nosotros</a>

                        </li>
                @endif
                

                



                @if(Auth::check() && (Auth::user()->rol == 'admin' || Auth::user()->rol == 'emple'))


                    <li>

                        <a class="product1" href="{{url('/orders')}}">Ordenes</a>

                    </li>

                    <li>

                        <a class="product1" href="{{url('/marzam_orders')}}">Pedidos a Marzam</a>

                    </li>

                    <li>

                        <a class="product1" href="{{url('/empaquetado')}}">Empaquetado</a>

                    </li>

                    <li>

                        <a class="product1" href="{{url('/tracking')}}">Rastreo</a>

                    </li>

                    <li>

                        <a class="product1" href="{{url('/admin/recetas')}}">Recetas</a>

                    </li>

                @endif



                @if(Auth::check() && Auth::user()->rol == 'admin')
                <li>
                    <a class="product1" href="{{url('/envios')}}">Tarifas de envios</a>
                </li>
                <li>
                    <a class="product1" href="{{ url('/empleados') }}">Empleados</a>
                </li>
                @endif


                @if (Auth::guest())

                    <li><a href="{{ route('login') }}">Ingresar</a></li>

                    <li><a class="button special" href="{{ route('register') }}">Registrate</a></li>

                @else



                    <li>

                        <div class="dropdown">

                            <button class="btn btn-primary dropdown-toggle" type="button"

                                    data-toggle="dropdown"> {{ Auth::user()->name }}

                            </button>

                            <ul class="dropdown-menu dropdown1">

                                <li>

                                    <a href="{{url('user')}}">Mi perfil</a>

                                </li>

                                <li role="presentation">

                                    <a href="{{ route('logout') }}"

                                       onclick="event.preventDefault();

                                                         document.getElementById('logout-form').submit();">

                                        Cerrar Sesion

                                    </a>




                                   
                                </li>


                            </ul>

                        </div>

                    </li>





                @endif

            </ul>

        </nav>
        
    <form id="logout-form" action="{{ route('logout') }}" method="POST"

          style="display: none;">

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
         





    <footer id="footer">

         

        <div class="column_footer"> 

        <ul class="static">

                <li><a href="{{url('/faq')}}" class=""><span class="label">Preguntas Frecuentes</span></a></li>

                <br>

                <li><a href="{{url('/nosotros')}}" class=""><span class="label">Nosotros</span></a></li>

                <br>

                <li><a href="{{url('/privacidad')}}" class=""><span class="label">Aviso de Privacidad</span></a></li>

                <br>

                <li><a href="{{url('/contact')}}" class=""><span class="label">Contactanos</span></a></li>

                </ul>

                <ul class="icons">

                    <li><h3>CONTÁCTANOS</h3></li><br>

                    <li><span>01 800 269 980 1</span></li>

                    <li><span>info@tufarmacialatina.com</span></li>

                </ul>

                <ul class="copyright">

                    <li><img src="{{ asset('img/pp.png') }}" alt=""></li>

                </ul>

        </div>

       <ul class="copyright">


                    <li>&copy; Untitled. All rights reserved.</li>

                    <li>© 2017 RX LATIN MED</li>

                </ul>



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
            window.location.href = "/botica_byw/public/products/"+ui.item.url;
            
            
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

