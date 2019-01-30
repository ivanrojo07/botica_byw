@extends('layouts.app')
@section('content')
    <section id="four" class="wrapper style1 special fade-up">
        <div class="container">
            <header class="major">
                <h2 class="grey satisfic-font font1">
                    Bienvenido {{Auth::user()->name}} al panel de gestion
                </h2>
                <p class="pprofile">
                    Desde "Mi Panel" tienes la posibilidad
                    de ver tu actividad reciente y actualizar tu información.
                </p>
            </header>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="list-group text-left">
                    <img src="{{url (Auth::user()->imgprofile)}}" class="img-responsive imgprofile " alt="">
                    <a href="javascript:void(0);" class="list-group-item active">
                        Opciones:
                    </a>
                    <a href="{{url('user/profile')}}" class="list-group-item">
                        Cambiar mi imagen de perfil
                    </a>
                    <a href="{{url('user/password')}}" class="list-group-item">
                        Cambiar mi contraseña
                    </a>
                    @if (Auth::user()->rol == "normal")
                        {{-- expr --}}
                        {{-- <a href="{{url('user/direccion')}}" class="list-group-item">
                            Gestiona tus Direcciones
                        </a> --}}
                        <a href="{{url('user/my-favorite-products')}}" class="list-group-item">
                            Mis Productos Favoritos
                        </a>
                        <a href="{{ url('user/my-orders') }}" class="list-group-item">
                            Mis Ordenes
                        </a>
                        <a href="{{ route('users.pedidos') }}" class="list-group-item">Mis Pedidos</a>
                    @endif
                </div>
            </div>    
                @if (Auth::user()->rol == 'admin')
                    {{-- expr --}}
                <div class="col-md-8">
                    <h1 class="grey satisfic-font font1">
                        Tipo de cambio del dolar a ${{$cambio->pesos}} MXN
                    </h1>
                    <br>
                    <form method="POST" action="{{ url('/moneda') }}">
                        {{ csrf_field() }}
                        <div class="col-md-offset-4 col-md-4">
                        <div class="form-group">
                            <label for="moneda" class="col-form-label col-form-label-lg">Dolar</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                              </div>
                              <input type="text" class="form-control" id="moneda" type="number" name="moneda" value="{{$cambio->pesos}}" step="0.01">
                              <div class="input-group-append">
                                <span class="input-group-text">USD</span>
                              </div>
                            </div>
                            {{-- <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group">$</span>
                                </div>
                              <input class="form-control col-md-4" >
                              <span class="input-group-addon">MXN</span>
                            </div> --}}
                            <br>
                            <button type="submit" class="btn btn-success">Cambiar</button>
                        </div>
                        </div>
                    </form>  
                </div>
                @endif
        </div>
    </section>
    <hr>
@endsection