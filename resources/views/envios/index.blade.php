@extends('layouts.app')
@section('content')
	{{-- expr --}}
	<section id="four" class="wrapper style1 special fade-up">
		<div class="row-8" id="productos">
			@include('feedback')
			<h4 style="color: black;">Zona de envios</h4>
			<a href="{{ route('envios.create') }}" class="btn btn-success">Nueva Tarifa</a>
			<br>
			<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th style="color: black;">Peso</th>
						<th  style="color: black;">Zona A</th>
						<th  style="color: black;">Zona B</th>
						<th  style="color: black;">Zona C</th>
						<th  style="color: black;">Zona D</th>
						<th  style="color: black;">Zona E</th>
						<th  style="color: black;">Zona F</th>
						<th  style="color: black;">Zona G</th>
						<th  style="color: black;">Zona H</th>
						<th  style="color: black;">Zona I</th>
						<th  style="color: black;">Acciones</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($envios as $key=> $envio)
						{{-- expr --}}
						<tr>
							<td>{{$envio->peso}} Kg.</td>
							<td>${{$envio->precio_a}} US</td>
							<td>${{$envio->precio_b}} US</td>
							<td>${{$envio->precio_c}} US</td>
							<td>${{$envio->precio_d}} US</td>
							<td>${{$envio->precio_e}} US</td>
							<td>${{$envio->precio_f}} US</td>
							<td>${{$envio->precio_g}} US</td>
							<td>${{$envio->precio_h}} US</td>
							<td>${{$envio->precio_i}} US</td>
							<td><a href="{{ route('envios.edit',['envio'=>$envio]) }}" class="btn btn-info">Editar Tarifa</a></td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</section>
@endsection