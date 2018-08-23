@extends('layouts.app')
@section('content')
	{{-- expr --}}
	<div class="container-fluid mt-5">
		<div class="panel panel-default">
			@include('feedback')
			<div class="panel-heading">
				<h2>Facturas</h2>

			</div>
			<div class="panel-body">
				<table class="table table-bordered table-responsive-md table-striped">
					<thead>
						<tr>
							<td scope="col">Numero de factura</td>
							<td scope="col">Fecha</td>
							<td scope="col">Código producto</td>
							<td scope="col">Nombre del producto</td>
							<td scope="col">Código de barras</td>
							<td scope="col">Clasificación fiscal</td>
							<td scope="col">Piezas</td>
							<td scope="col">Precio bruto</td>
							<td scope="col">IEPS</td>
							<td scope="col">IVA</td>
							<td scope="col">Precio neto</td>
							<td scope="col">Neto Unitario</td>
							<td>Acción</td>
						</tr>
					</thead>
					<tbody>
						@foreach ($facturas as $factura)
							{{-- expr --}}
							<tr>
								<td scope="col">{{$factura->numero}}</td>
								<td scope="col">{{$factura->fecha}}</td>
								<td scope="col">{{$factura->codigo_prod}}</td>
								<td scope="col">{{$factura->nombre_prod}}</td>
								<td scope="col">{{$factura->codigo_bar}}</td>
								<td scope="col">{{$factura->clas_fis}}</td>
								<td scope="col">{{$factura->piezas}}</td>
								<td scope="col">{{$factura->prec_bruto}}</td>
								<td scope="col">{{$factura->ieps}}</td>
								<td scope="col">{{$factura->iva}}</td>
								<td scope="col">{{$factura->neto}}</td>
								<td scope="col">{{$factura->neto_unit}}</td>
								<td>
									@if ($factura->in_shopping_cart->pagado)
										{{-- true expr --}}
										Se encuentra pagado
									@else
										{{-- false expr --}}
										<form method="POST" onSubmit="if(!confirm('Deseas confirmar que este producto ya esta pagado?')){return false;}" action="{{ route('pagado') }}">
											{{csrf_field()}}
											<input type="hidden" name="factura" value="{{$factura->id}}">
											
										<button class="btn btn-success" type="submit">Pagado</button>
										</form>
									@endif
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>

		</div>
	</div>
@endsection