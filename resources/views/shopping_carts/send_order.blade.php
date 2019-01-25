@extends('layouts.app')
@section('content')
<div class="container mt-2 mb-3">
	<div class="card card-default">
		<div class="card-header">
  			<h1 class="grey text-center">¡Tu compra ha sido terminada!</h1>
		</div>
		<div class="card-body">
			<h5 class="card-title">A continuación personal de RxLatinMed© se comunicará con usted para detallar los informes de su compra:</h5>
			<div class="row">
				<div class="col-3">
					<p>Nombre:</p>
				</div>
				<div class="col">
					<p>{{$shopping_cart->contacto->nombre}}</p>
				</div>
			</div>
			<div class="row">
				<div class="col-3">
					<p>Telefono:</p>
				</div>
				<div class="col">
					<p>{{$shopping_cart->contacto->codigo_pais." ".$shopping_cart->contacto->telefono}}</p>
				</div>
			</div>
			<div class="row">
				<div class="col-3">
					<p>Nombre:</p>
				</div>
				<div class="col">
					<p>{{$shopping_cart->contacto->email}}</p>
				</div>
			</div>
			<div class="row">
				
		    	<div class="col">El total de tu(s) producto(s) es:</div>
		    	<div class="col">${{ $shopping_cart->total }} USD</div>
		    
			</div>
	      	<button onclick="window.location.href='{{url('/user/my-orders')}}'" type="button" class="btn btn-primary btn-block center-block">Regresar</button>
	      	<br>
		</div>
	</div>
</div>
@endsection