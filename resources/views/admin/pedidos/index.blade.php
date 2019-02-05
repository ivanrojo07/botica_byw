@extends('layouts.app')
@section('content')
<div class="container-fluid">
	<div class="card mt-3 mb-3 card-default">
		<div class="card-header">
			<h4>Pedidos</h4>
		</div>
		<div class="card-body">
			<table class="table table-bordered">
				<thead class="thead-dark">
					<tr>
						<th scope="col">Pedido</th>
						<th scope="col">Contacto</th>
						<th scope="col">Productos</th>
						<th scope="col">Fecha</th>
						<th scope="col">Total de productos</th>
						<th scope="col">Acciones</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($pedidos as $pedido)
						<tr>
							<th scope="row" class="text-center">{{$pedido->id}}</th>
							<td>
								<ul class="list-group">
								  	<li class="list-group-item text-center"><strong>Contacto:</strong> {{$pedido->contacto->nombre}}</li>
								  	<li class="list-group-item text-center"><strong>Correo:</strong> {{$pedido->contacto->email}}</li>
						  			<li class="list-group-item text-center"><strong>Telefono: </strong> {{$pedido->contacto->codigo_pais." ".$pedido->contacto->telefono}}</li>
								</ul>
							</td>
							<td>
								<ul class="list-group">
									@foreach ($pedido->products as $producto)
									<li class="list-group-item d-flex justify-content-between align-items-center">
								    	{{$producto->descripcion}}
								    	<span class="badge badge-primary badge-pill">{{$producto->pivot->qty}}</span>
								  	</li>
									@endforeach
								</ul>
							</td>
							<td class="text-center">
								{{$pedido->updated_at->format('d-m-Y')}}
							</td>
							<td class="text-center">
								<strong>
									$ {{$pedido->total}} USD
								</strong>
							</td>
							<td class="text-center">
								<div class="mb-3">
									<a href="{{ route('pedidos.show',['pedido'=>$pedido]) }}" class="btn btn-success">Ver pedido</a>
								</div>
								<div class="mb-3">
									<a href="" class="btn btn-info">Agregar <br> información <br> de envio</a>
								</div>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection