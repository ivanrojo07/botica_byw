<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head><meta http-equiv="Content-Type" content="text/html; charset=shift_jis">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>TuFarmaciaLatina.com</title>

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/icon?family=Material+Icons">

    <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css"
          href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}"/>
    <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css"
          rel="stylesheet"/>


    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>

</head>
<body class="landing">

<div id="page-wrapper">
    <header id="header">
        <h1 id="logo"><a href="{{ url('/') }}">Inicio</a></h1>
        <nav id="nav">
            <ul>

                <li>


                    {!! Form::open(['url' => '/Products1', 'method' => 'GET', 'class' => 'navbar-form pull-left']) !!}
                    <div class="form-group">
                        {!! Form::text ('title', null, ['class' => 'form-control btn-search', 'placeholder' => 'buscar tu medicamento', 'aria-describedby' => 'search'])!!}
                    </div>
                    <button type="submit" class="btn btn-default btn-search2" id="search" aria-hidden="true">Buscar
                    </button>

                    {!! Form::close() !!}
                    <a href="{{url('/carrito')}}"><i class="fa fa-cart-plus blue" aria-hidden="true"></i>
                        {{$productsCount}}</a></li>
                <li>
                 @if(Request::is('/'))
                 <a class="product1" href="#productos">Productos</a>
                 @else
                 <a class="product1" href="{{url('/Products1')}}">Productos</a>
                 @endif                        
                </li>

                <li>
                    <a class="product1" href="{{url('/promotions')}}">Promociones</a>
                </li>

                @if(Auth::check() && Auth::user()->rol == 'admin')
                    <li>
                        <a class="product1" href="{{url('/admin/sales')}}">Productos Vendidos</a>
                    </li>
                @else
                     <li>
                            <a class="product1" href="{{url('/nosotros')}}">Nosotros</a>
                        </li>
                @endif

                @if(Auth::check() && Auth::user()->rol == 'admin')
                    <li>
                        <a class="product1" href="{{url('/orders')}}">Ordenes</a>
                    </li>
                @endif

                @if(Auth::check() && Auth::user()->rol == 'admin')
                    <li>
                        <a class="product1" href="{{url('/admin/recetas')}}">Recetas</a>
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
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                        Cerrar Sesion
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                                <br>
                                <li>
                                    <a href="{{url('user')}}">Mi perfil</a>
                                </li>

                            </ul>
                        </div>
                    </li>


                @endif
            </ul>
        </nav>
    </header>
    <span class="ir-arriba fa fa-arrow-up">
            
        </span>
    @yield('content')

    <footer id="footer">
         
        <div class="column_footer"> 
        <ul class="static">
                <li><a href="{{url('/faq')}}" class=""><span class="label">Preguntas Frecuentes</span></a></li>
                
                <li><a href="{{url('/nosotros')}}" class=""><span class="label">Nosotros</span></a></li>
                
                <li><a href="{{url('/privacidad')}}" class=""><span class="label">Aviso de Privacidad</span></a></li>
           
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

<script src="{{ url('/js/jquery.min.js') }}"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
<script src="{{ url('/js/editable.js') }}"></script>
<script src="{{ url('/js/app.js') }}"></script>
@yield('scripts')
</body>
</html>
