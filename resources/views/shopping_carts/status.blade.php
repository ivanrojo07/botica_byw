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
		</div>
		<div class="card-footer">
			<div class="d-flex justify-content-around">
				<div class="p-2">
					<a href="#" class="btn btn-success disabled">
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