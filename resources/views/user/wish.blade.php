@extends('layouts.app')
@section('content')
	<div class="container">
		<div class="row">
			<div class="col-12">
				<h2 class="grey satisfic-font font1">
					Mis pedidos
				</h2>
			</div>
			<div class="col-12">
				<p class="profile">
					Visualiza los pedidos que has realizado en TuFarmaciaLatina.com. Tambien en esta sección puedes pagar tus pedidos.
				</p>
			</div>
		</div>
		<div class="container mt-3 mb-3">
			<table class="table table-hover table-bordered table-striped">
				<thead  class="thead-light">
					<tr>
						<th>Productos</th>
						<th>Total de los productos</th>
						<th>Receta</th>
						<th>Fecha de pedido</th>
						<th>Detalles</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($shoppingcarts as $cart)
						<tr>
							<td>
								<ul>
									@foreach ($cart->products as $producto)
								  		<li class="d-flex justify-content-between align-items-center">
								  			{{$producto->descripcion}}
								  			<span class="badge badge-primary badge-pill">{{$producto->pivot->qty}}</span>
								  		</li>
									@endforeach
								</ul>
							</td>
							<td>
								<p class="d-flex justify-content-center align-items-center">
									$ {{$cart->total}} USD
								</p>
								@if ($cart->totalenvio != 0.00)
									<p class="d-flex justify-content-center align-items-center">
										Más costo de envio: $ {{$cart->totalenvio}} USD
									</p>
									<p class="d-flex justify-content-center align-items-center">
										Total a pagar: $ {{$cart->total+$cart->totalenvio}} USD
									</p>
								@endif
							</td>
							<td>
								<form action="{{ url('/user/order/get-receta') }}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="url_receta_path"
                                           value="{{ $cart->receta_path }}"/>
                                    <button  class="btn btn-success" type="submit">
                                        Descargar Receta
                                    </button>
                                </form>
							</td>
							<td>
								<p class="d-flex justify-content-center align-items-center">
									{{$cart->updated_at->format('d-m-Y')}}
								</p>
							</td>
							<td>
								<div class="d-flex bd-highlight mb-3">
									 <a class="align-self-center p-2 ml-2 bd-highlight btn btn-success {{$cart->totalenvio =! 0.00 && $cart->direccion ? '' : 'disabled'}}" href="{{$cart->totalenvio =! 0.00 && $cart->direccion ? route('payment') : '#'}}">
									 	<i class="fa fa-credit-card-alt" aria-hidden="true"> Pagar</i>
									 </a>
								</div>
								<div class="d-flex bd-highlight mb-3">
									 <a class="align-self-center p-2 bd-highlight btn btn-info" href="{{ route('wish',['shopping_cart'=>$cart]) }}">Ver Pedido</a>
								</div>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
@endsection