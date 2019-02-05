@extends('layouts.app')
@section('content')
<div class="container">
	<div class="card card-default">
		<div class="card-header">
			<div class="d-flex bd-highlight">
				<div class="p-2 flex-grow-1 bd-highlight">
					<h2 class="title">
						Pedido #{{$pedido->id}} realizado el {{$pedido->updated_at->format('d-m-Y')}}
					</h2>
				</div>
				<div class="p-2 bd-highlight">
					<img src="{{asset('img/logo_rxlatinmed.jpg')}}" height="60px">
				</div>
				<div class="p-2 bd-highlight">
					<img src="{{ asset('/img/sky.png') }}" height="60px">
				</div>
			</div>
		</div>
		<div class="card-body">
			<table class="table table-hover table-bordered table-striped table-dark">
				<thead>
					<tr class="text-center">
						<th scope="col">Producto</th>
						<th scope="col">Cantidad</th>
						<th scope="col">Precio unitario</th>
						<th scope="col">Total</th>
						<th scope="col">Peso Aprox</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($pedido->products as $producto)
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
							<td class="text-center">
								{{$producto->peso['peso']." ".$producto->peso['medida']}}
							</td>
						</tr>
					@endforeach
					<tr>
						<td class="text-center">
							Total de productos
						</td>
						<td></td>
						<td></td>
						<td class="text-center">
							$ {{$pedido->total}} USD
						</td>
						<td class="text-center">
							{{$pedido->peso['peso']." ".$pedido->peso['medida']}}
						</td>
					</tr>
					@if ($pedido->totalenvio != 0.00)
						<tr>
							<td class="text-center">
								Total envio
							</td>
							<td></td>
							<td></td>
							<td class="text-center">
								$ {{$pedido->totalenvio}} USD
							</td>
							<td></td>
						</tr>
					@endif
					<tr>
						<td class="text-center">
							Total
						</td>
						<td></td>
						<td></td>
						<td class="text-center">
							$ {{$pedido->total+$pedido->totalenvio}} USD
						</td>
						<td class="text-center">
						</td>
					</tr>
				</tbody>
			</table>
			<div class="row">
				<div class="col-6 mb-2 align-self-center">
					<div class="card border-info text-center">
						<div class="card-header bg-info text-white">
							<h3>
								<strong>
									Datos del cliente:
								</strong>
							</h3>	
						</div>
						<div class="card-body">
							<p>
								<strong>Nombre de usuario:</strong> {{$pedido->user->name}} 
							</p>
							<p>
								<strong>Correo:</strong> {{$pedido->user->email}}
							</p>
							<p>
								<form action="{{ url('/user/order/get-receta') }}" method="POST" style="margin: 0px 0 1em 0;">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="url_receta_path"
                                           value="{{ $pedido->receta_path }}"/>
                                    <button class="btn btn-sm btn-info">Descargar Receta</button>
                                </form>
							</p>
						</div>
					</div>
				</div>
				<div class="col-6 mb-2 align-self-center">
					<div class="card border-info text-center">
						<div class="card-header bg-info text-white">
							<h3><strong>Datos del contacto:</strong></h3>
						</div>
						<div class="card-body">
							<p>
								<strong>Nombre del contacto: </strong> {{$pedido->contacto->nombre}} 
							</p>
							<p><strong>Correo del contacto:</strong> {{$pedido->contacto->email}}</p>
							<p><strong>Telefono del contacto:</strong> {{$pedido->contacto->codigo_pais." ".$pedido->contacto->telefono}}</p>
						</div>
					</div>
				</div>
				@if ($pedido->direccion)
					<div class="col-12 align-self-center">
						<div class="card border-info text-center">
							<div class="card-header bg-info text-white">
								<h3><strong>Datos de direccion de envio:</strong></h3>
							</div>
							<div class="card-body">
								<div class="row">
									<div class="col-6 mt-3">
										<strong>Nombre del destinatario (quien reciba): </strong>
										{{$pedido->direccion->name}}
									</div>
									<div class="col-6 mt-3">
										<strong>Email del destinatario (quien reciba): </strong>
										{{$pedido->direccion->email}}
									</div>
									<div class="col-6 mt-3">
										<strong>Telefono del destinatario (quien reciba):</strong>
										{{$pedido->direccion->contacto}}
									</div>
									<div class="col-6 mt-3">
										<strong>Telefono del remitente (quien envia):</strong>
										{{$pedido->direccion->telefono}}
									</div>
									<div class="col-6 mt-3">
										<strong>Calle: </strong>
										{{$pedido->direccion->calle}}
									</div>
									<div class="col-6 mt-3">
										<strong>Numero exterior: </strong>
										{{$pedido->direccion->num_ext}}
									</div>
									<div class="col-6 mt-3">
										<strong>Numero interior: </strong>
										{{$pedido->direccion->num_int}}
									</div>
									<div class="col-6 mt-3">
										<strong>Colonia ó localidad: </strong>
										{{$pedido->direccion->colonia}}
									</div>
									<div class="col-6 mt-3">
										<strong>Codigo postal: </strong>
										{{$pedido->direccion->codigop}}
									</div>
									<div class="col-6 mt-3">
										<strong>Estado ó provincia ó departamento: </strong>
										{{$pedido->direccion->estado}}
									</div>
									<div class="col-6 mt-3">
										<strong>Municipio ó población: </strong>
										{{$pedido->direccion->municipio}}
									</div>
									<div class="col-6 mt-3">
										<strong>Ciudad: </strong>
										{{$pedido->direccion->ciudad}}
									</div>
									<div class="col-6 mt-3">
										<strong>País: </strong>
										{{$pedido->direccion->pais}}
									</div>
									<div class="col-6 mt-3">
										<strong>Entre calle: </strong>
										{{$pedido->direccion->entre1 ? $pedido->direccion->entre1 : "N/A"}}
										 y 
										{{$pedido->direccion->entre2 ? $pedido->direccion->entre2 : "N/A"}}
									</div>
									<div class="col-6 mt-3">
										<strong>Refencia adicional: </strong>
										{{$pedido->direccion->references ? $pedido->direccion->references : "N/A" }}
									</div>
								</div>
							</div>
						</div>
					</div>
					
				@endif
			</div>
		</div>
		<div class="card-footer">
			<div class="d-flex justify-content-around">
				<div class="p-2">
					<a href="{{$pedido->direccion ? route('pedidos.direccions.edit',['pedido'=>$pedido,'direccion'=>$pedido->direccion]) : route('pedidos.direccions.create',['pedido'=>$pedido]) }}" class="btn btn-success">
						<i class="fa fa-truck" aria-hidden="true"></i> {{$pedido->direccion ? "Editar " : "Agregar " }} dirección de envio</i>
					</a>
				</div>
				<div class="p-2">
					<a href="#" class="btn btn-danger">
						<i class="fa fa-trash" aria-hidden="true"></i> Archivar pedido</i>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection