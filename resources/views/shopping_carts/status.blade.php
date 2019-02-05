@extends('layouts.app')
@section('content')
<div class="container">
	<div class="card card-default">
		<div class="card-header">
			<div class="d-flex bd-highlight">
				<div class="p-2 flex-grow-1 bd-highlight">
					<h2 class="title">
						Pedido #{{$shopping_cart->id}} realizado el {{$shopping_cart->updated_at->format('d-m-Y')}}
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
					@if ($shopping_cart->totalenvio != 0.00)
						<tr>
							<td class="text-center">
								Total envio
							</td>
							<td></td>
							<td></td>
							<td class="text-center">
								$ {{$shopping_cart->totalenvio}} USD
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
							$ {{$shopping_cart->total+$shopping_cart->totalenvio}} USD
						</td>
						<td class="text-center">
						</td>
					</tr>
				</tbody>
			</table>
			@if ($shopping_cart->direccion)
				<div class="col-12 align-self-center">
					<div class="card border-info text-center">
						<div class="card-header bg-info text-white">
							<h3><strong>Datos de direccion de envio:</strong></h3>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-6 mt-3">
									<strong>Nombre del destinatario (quien reciba): </strong>
									{{$shopping_cart->direccion->name}}
								</div>
								<div class="col-6 mt-3">
									<strong>Email del destinatario (quien reciba): </strong>
									{{$shopping_cart->direccion->email}}
								</div>
								<div class="col-6 mt-3">
									<strong>Telefono del destinatario (quien reciba):</strong>
									{{$shopping_cart->direccion->contacto}}
								</div>
								<div class="col-6 mt-3">
									<strong>Telefono del remitente (quien envia):</strong>
									{{$shopping_cart->direccion->telefono}}
								</div>
								<div class="col-6 mt-3">
									<strong>Calle: </strong>
									{{$shopping_cart->direccion->calle}}
								</div>
								<div class="col-6 mt-3">
									<strong>Numero exterior: </strong>
									{{$shopping_cart->direccion->num_ext}}
								</div>
								<div class="col-6 mt-3">
									<strong>Numero interior: </strong>
									{{$shopping_cart->direccion->num_int}}
								</div>
								<div class="col-6 mt-3">
									<strong>Colonia ó localidad: </strong>
									{{$shopping_cart->direccion->colonia}}
								</div>
								<div class="col-6 mt-3">
									<strong>Codigo postal: </strong>
									{{$shopping_cart->direccion->codigop}}
								</div>
								<div class="col-6 mt-3">
									<strong>Estado ó provincia ó departamento: </strong>
									{{$shopping_cart->direccion->estado}}
								</div>
								<div class="col-6 mt-3">
									<strong>Municipio ó población: </strong>
									{{$shopping_cart->direccion->municipio}}
								</div>
								<div class="col-6 mt-3">
									<strong>Ciudad: </strong>
									{{$shopping_cart->direccion->ciudad}}
								</div>
								<div class="col-6 mt-3">
									<strong>País: </strong>
									{{$shopping_cart->direccion->pais}}
								</div>
								<div class="col-6 mt-3">
									<strong>Entre calle: </strong>
									{{$shopping_cart->direccion->entre1 ? $shopping_cart->direccion->entre1 : "N/A"}}
									 y 
									{{$shopping_cart->direccion->entre2 ? $shopping_cart->direccion->entre2 : "N/A"}}
								</div>
								<div class="col-6 mt-3">
									<strong>Refencia adicional: </strong>
									{{$shopping_cart->direccion->references ? $shopping_cart->direccion->references : "N/A" }}
								</div>
								<div class="col-12 mt-2 align-self-center">
									<p class="text-center">
										<strong>
											Si tienes dudas o aclaraciones sobre el pedido o su dirección de envio, comuniquese directamente a nuestro telefono de atención al cliente:
										</strong>
									</p>
									<p class="text-center">
										<strong>
											01-800-269-980-1
										</strong>
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			@else
				<div class="row">
					<div class="col align-self-center">
						<p>
							<strong>
								Para finalizar tú pedido es necesario corroborar algunos datos.
							</strong>
						</p>
						<p>
							Por favor comuniquese a los telefonos de TuFarmaciaLatina.com para que uno de nuestros agentes ayude en la finalización de esta compra.
						</p>
						<p>
							<strong>Aviso importante:</strong>
						</p>
						<p>
							Nuestros agentes de TuFarmaciaLatina.com nunca pedirán información bancaria para la finalización de esta compra.
						</p>
					</div>
					<div class="col align-self-center">
						<p class="text-center">
							<strong>
								Telefonos de atención al cliente:
							</strong>
						</p>
						<p class="text-center">
							<strong>
								01-800-269-980-1
							</strong>
						</p>
					</div>
				</div>
			
			@endif
		</div>
		<div class="card-footer">
			<div class="d-flex justify-content-around">
				<div class="p-2">
					<a href="{{ $shopping_cart->direccion && $shopping_cart->totalenvio != 0.00 ? route('payment') : '#' }}" class="btn btn-success {{ $shopping_cart->direccion && $shopping_cart->totalenvio != 0.00 ? '' : 'disabled' }}">
						<i class="fa fa-credit-card-alt" aria-hidden="true"> PAGAR</i>
					</a>
				</div>
				<div class="p-2">
					<a href="{{ route('users.pedidos') }}" class="btn btn-secondary"> Regresar</a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection