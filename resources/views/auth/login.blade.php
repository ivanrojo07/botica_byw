@extends('layouts.app')
@section('content')
<div class="container margin-bot1" style="margin-top: 65px">
<header class="major margin-top">
                            <h2 class="margin-bottom1 header-text">Inicia sesión y ¡conoce nuestro catálogo de Farmacia!</h2>
</header>
    <div class="row">
      <div class="4u 12u$(medium) sidebar1">
                                <!-- Sidebar -->
                                    <section id="sidebar" class="color-grey">
                                        <section>
                                            <h3 class="color-grey font-ch"><a href="{{ url('/register') }}">Crea tu Cuenta</a></h3>
                                            <p>Si no tienes cuenta de usuario en MiBoticaLatina, utiliza esta opción para acceder al formulario de registro. La información que te solicitaremos es imprescindible para agilizar el proceso de compra. </p>
                                        </section>
                                    </section>
                            </div>
        <div class="col-md-12 panel-login"
            <div class="panel panel-default">
                <div class="panel-heading header-text color-grey font-ch">Iniciar</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Correo</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Contraseña</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Recordar
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Ingresar
                                </button>
                                <a class="btn btn-link link" href="{{ route('password.request') }}">
                                    ¿Olvidaste tu contraseña?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

