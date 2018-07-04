@extends('layouts.app')
@section('content')
	{{-- expr --}}
	<section id="four" class="wrapper style1 special fade-up">
		<div id="productos" class="container">
			<div class="panel panel-default dashadmin">
				@include('feedback')
				<div class="panel-heading">
					<h2>{{ $edit == true ? "Editar" : "Nuevo" }} Usuario</h2>
				</div>
				<div class="panel-body">
					            <div class=" panel-default ">
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ $edit === true ? route('empleados.update',["empleado"=>$usuario]) : route('empleados.store') }}">
                        {{ csrf_field() }}
                        @if ($edit == true)
                        	{{-- expr --}}
                        	<input type="hidden" name="_method" value="PUT">
                        @endif
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nombre</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $edit === true ? "$usuario->name" : old('name') }}" required autofocus>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Correo</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $edit === true ? "$usuario->email" : old('email') }}" required>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('rol') ? ' has-error': '' }}">
                        	<label for="rol" class="col-md-4 control-label">Rol</label>
                        	<div class="col-md-6">
                        		<select class="form-control" id="rol" name="rol">
                        			<option value="admin" {{ $usuario->rol == "admin" ? "selected" : ""}}>Administrador</option>
                        			<option value="emple" {{ $usuario->rol == "emple" ? "selected" : ""}}>Empleado</option>
                        		</select>
                        		@if ($errors->has('rol'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('rol') }}</strong>
                                    </span>
                                @endif
                        	</div>
                        </div>
                        @if ($edit == false)
                        	{{-- expr --}}
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
                            <label for="password-confirm" class="col-md-4 control-label">Confirmar Contraseña</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>
                        @endif
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary btn-block">
                                    Registrar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
				</div>
			</div>
		</div>
	</section>
@endsection