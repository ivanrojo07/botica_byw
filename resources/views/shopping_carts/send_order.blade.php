@extends('layouts.app')
@section('content')
<div class="container">
	<div class="card card-default">
		<div class="card-header">
			<div class="d-flex bd-highlight">
				<div class="p-2 flex-grow-1 bd-highlight">
  					<h1 class="grey text-center">¡Tu compra esta a punto de finalizar!</h1>
				</div>
				<div class="p-2 bd-highlight">
					<img src="{{asset('img/logo_rxlatinmed.jpg')}}" height="60px">
				</div>
			</div>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col">
					<h5 class="card-title">A continuación personal de RxLatinMed© se comunicará con usted para detallar los informes de su compra:</h5>
				</div>
			</div>
			<div class="row">
				<div class="col-3">
					<p>
						<strong>
							Nombre:
						</strong>
					</p>
				</div>
				<div class="col">
					<p>{{$shopping_cart->contacto->nombre}}</p>
				</div>
			</div>
			<div class="row">
				<div class="col-3">
					<p>
						<strong>Telefono:</strong>
					</p>
				</div>
				<div class="col">
					<p>{{$shopping_cart->contacto->codigo_pais." ".$shopping_cart->contacto->telefono}}</p>
				</div>
			</div>
			<div class="row mb-3">
				<div class="col-3">
					<p>
						<strong>Correo:</strong>
					</p>
				</div>
				<div class="col">
					<p>{{$shopping_cart->contacto->email}}</p>
				</div>
			</div>
			<table class="table table-hover table-bordered table-striped table-dark">
				<thead>
					<tr class="text-center">
						<th scope="col">Producto</th>
						<th scope="col">Cantidad</th>
						<th scope="col">Precio unitario</th>
						<th scope="col">Total</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($shopping_cart->products as $producto)
						<tr>
							<td class="text-center">
								<a href="{{ url('products/'.$producto->id) }}" class="btn btn-link" style="color:white;">
									{{$producto->descripcion}}
								</a>
							</td>
							<td class="text-center">
								{{$producto->pivot->qty}}
							</td>
							<td class="text-center">
								$ {{$producto->pivot->preciounit}} USD
							</td>
							<td class="text-center">
								$ {{$producto->pivot->preciounit* $producto->pivot->qty}} USD
							</td>
						</tr>
					@endforeach
					<tr>
						
					</tr>
					<tr>
						<td class="text-center">
							Total
						</td>
						<td></td>
						<td></td>
						<td class="text-center">
							$ {{$shopping_cart->total}} USD
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="card-footer">
			<div class="d-flex justify-content-end">
				<div class="p-2">
					<a href="{{ route('users.pedidos') }}" class="btn btn-secondary"> Regresar</a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection