@extends('layouts.app')
@section('content')
	{{-- expr --}}
	<section id="four" class="wrapper style1 special fade-up">
		<div id="productos" class="container">
			<div class="panel panel-default dashadmin">
				@include('feedback')
				<div class="panel-heading">
					<h2>Usuarios</h2>
					<a href="{{ route('empleados.create') }}" class="btn btn-info">Nuevo Usuario</a>
				</div>
				<div class="panel-body">
					<table class="table table-bordered tabla-status table-striped">
						<thead>
							<tr>
								<td>Nombre de usuario</td>
								<td>Email</td>
								<td>Rol</td>
								<td>Acciones</td>
							</tr>
						</thead>
						<tbody>
							@foreach ($usuarios as $usuario)
								{{-- expr --}}
								<tr>
									<td>{{$usuario->name}}</td>
									<td>{{$usuario->email}}</td>
									<td>{{$usuario->rol === "admin" ? "Administrador" : "Empleado"}}</td>
									<td>
										<a href="{{ route('empleados.edit',['user_id'=>$usuario->id]) }}" class="btn btn-success">Editar usuario</a>
										<form style="margin: 5px 0 0em 0 !important;" id="destroy {{ $usuario->id }}" method="POST" action="{{ route('empleados.destroy',['empleado'=>$usuario]) }}" onsubmit="return confirm('¿Deseas eliminar a este usuario?');">
											{{ csrf_field() }}
											<input type="hidden" name="_method" value="DELETE">
											<input type="hidden" name="empleado" value="{{$usuario->id}}">
											<button class="btn btn-danger">Eliminar usuario</button>
										</form>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</section>

@endsection