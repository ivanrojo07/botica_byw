@extends('layouts.app')
@section('content')
	{{-- expr --}}

	<section id="four" class="wrapper style1 special fade-up">
		
	<div class="container-fluid">
		<div class="panel-body">
			@include('feedback')
			<div class="col-lg-6">
				<form id="buscartraking" action="busqueda"
				o onKeypress="if(event.keyCode == 13) event.returnValue = false;">
				<!-- {{ csrf_field() }} -->
				<div class="input-group" id="datos1">
					<input type="text" id="query" name="query" list="browsers" class="form-control" placeholder="Buscar..." autofocus>
					<span class="input-group-addon" id="basic-addon2"><i class="fas fa-search"></i></span>
				</div>
				</form>
			</div>
			
		</div>
			
	<div class="panel panel-default" @if ($trackings->isEmpty())
		{{-- expr --}}
		style="height: 506px;" 
	@endif>
		<div class="page-header">

			<button class="btn btn-warning" 
			        data-toggle="modal" 
					data-target="#modal">
				    Nuevo Tracking</button> <br><br>
		<div id="datos" name="datos">
			<table class="table table-striped table-bordered table-hover" style="border-collapse: collapse; margin-bottom: 0px;">
			<thead>
				<tr class="info">
					<th style="color:black;text-align: center"><strong>HAWB</strong></th>
					<th style="color:black;text-align: center"><strong>Orden</strong></th>
					<th style="color:black;text-align: center"><strong>Destino</strong></th>
					<th style="color:black;text-align: center"><strong>Bultos</strong></th>
					<th style="color:black;text-align: center"><strong>Peso</strong></th>
					<th style="color:black;text-align: center"><strong>Fecha de Registro</strong></th>
					
				</tr>
			</thead>
			
			@foreach ($trackings as $tracking)
				{{-- expr --}}
				<tr title="Has Click Aquì para Ver"
					style="cursor: pointer;"
					data-toggle="collapse" 
					data-target="#{{$tracking->id}}">
					
					
					<td >{{$tracking->hawb}}</td>
					<td>{{$tracking->orden->shoppingCart->customid}}</td>
					<td>{{$tracking->destino}}</td>
					<td>{{$tracking->bultos}}</td>
					<td>{{$tracking->peso}}Kg</td>
					<td>{{$tracking->created_at}}</td>
				</tr>
			@endforeach
			</table>
		</div>
			

		</div>

		 @foreach ($trackings as $tracking)
		<div class="panel-body collapse" id="{{$tracking->id}}" style="color: black;">

			
			<div class="panel-header">  <br><br>

			<strong>Hitos/Status {{$tracking->hawb}}</strong>	


			</div>


			
  <div class="panel">
  	<form method="POST" action="{{route('status.store')}}">
			{{ csrf_field() }}
			<input type="hidden" name="tracking_id" id="tracking_id" value="{{$tracking->id}}">

			
				<div class="form-group">
					<div class="row">
								        	<div class="col-sm-3">   
								        		<label for="status"> Status:</label>
							<input type="text" class="form-control" name="status" id="status" placeholder="Hito o Status" required style="size:150px !important; height: 35px;">
											</div>
											<div class="c2ol-sm-3">   
								        		<label for="hora">Hora:</label>
							<input type="time" class="form-control" name="hora" id="hora" required style="size: 100px; height: 35px;">
											</div>
											<div class="c2ol-sm-3">   
								        		<label for="fecha">Fecha:</label>
							<input type="date" class="form-control" name="fecha" id="fecha" required style="size: 100px; height: 35px;">
											</div>
											<div class="c2ol-sm-3"> 
											<br>  
								        		<input type="submit" class="btn btn-primary" value="Agregar">
											</div>
											
                  </div>
                </div>

	</form>
  	
  </div>
 
 
  	
  	<table class="table table-striped table-bordered table-hover" style="border-collapse: collapse; margin-bottom: 0px;">
		<thead>
			<tr class="info">
				<th style="color:black;text-align: center"><strong>STATUS</strong></th>
				<th style="color:black;text-align: center"><strong>HORA</strong></th>
				<th style="color:black;text-align: center"><strong>FECHA</strong></th>
				
				
			</tr>
		</thead>
		<tbody>
			@foreach($tracking->hito as $hito)
			<tr>
		<td>{{$hito->status}}</td>
		<td>{{$hito->hora}}</td>
		<td>{{$hito->fecha}}</td>
		   <tr>
		 @endforeach

		</tbody>
	  
	</table>




	</div>

		

		 @endforeach
	</div>
	</div>


	



	{{-- MODAL --}}
					<div class="modal" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="position: 0,0 !important; ">
								  <div class="modal-dialog" role="document">
								    <div class="modal-content">
								      <div class="modal-header">
								        <h5 class="modal-title" id="exampleModalLongTitle" style="color: black;"><strong>Agregar Nuevo Tracking</strong>
								        </h5>
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								          <span aria-hidden="true"><i class="fa fa-times-circle" aria-hidden="true"></i></span>
								        </button>
								      </div>

		<form method="POST" action="{{route('tracking.store')}}">
			{{ csrf_field() }}
			<div class="modal-body">
				<div class="row">
								        	<div class="col-sm-offset-1 col-sm-5">   
								        		<label for="hawb"> HAWB:</label>
							<input type="text" class="form-control" name="hawb" id="hawb" placeholder="Clave HAWB" required style="size: 170px; height: 35px;">
											</div>
											<div class=" col-sm-5">   
								        		<label for="orden_id"> Orden de Compra:</label>
							<select class="form-control" id="orden_id" name="orden_id" onchange="orden(this.value)" required>
								<option>Seleccione una opcion</option>
								@foreach($orders as $order)
        						<option value="{{$order->id}}">{{$order->shoppingCart->customid}}</option>
        						@endforeach
     					    </select>
											</div>
											
                 
                </div>
                <br>
                <div class="row">
                	<div class="col-sm-offset-1  col-sm-10">   
							
						
			        		<label for="destino"> Destino:</label>
								<input type="text" class="form-control" name="destino" id="destino" placeholder="Destino" required style="size: 200px; height: 35px;" value="{{ $order->shopp }}">
						
                	</div>
                </div>
                <br>
                 <div class="row">
                	<div class="col-sm-offset-1  col-sm-5">   
								        		<label for="bultos">Número de Bultos:</label>
							<select class="form-control" id="bultos" name="bultos" required>
        						<option value="1">1</option>
        						<option value="2">2</option>
        						<option value="3">3</option>
        						<option value="4">4</option>
        						<option value="5">5</option>
        						<option value="6">6</option>
        						<option value="7">7</option>
     					    </select>
											</div>
											<div class="col-sm-5">   
								        		<label for="peso"> Peso:</label>
							<input type="text" class="form-control" name="peso" id="peso" placeholder="-Kg-" required style="size: 170px; height: 35px;">
											</div>
                </div>
                <br>
                <div class="row">
                	<div class="col-sm-offset-1  col-sm-10">
                		<label for="direccion">Dirección:</label>
                		<textarea class="form-control" readonly="readonly" id="direccion" rows="8"></textarea>
                	</div>
                </div>
			</div>


				<div class="modal-footer">

				<input type="submit" class="btn btn-primary" value="Guardar">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
							</div>	       
			</form>

								    
								  </div>
								</div>

					{{-- MODAL --}}








					




</section>

@endsection

@section('scripts')
	{{-- expr --}}
<script>
	// alert('hola');
	function orden (kw) {

		$.ajax({
			url: "{{ url('/ordens') }}",
			type: "GET",
			dataType: "json",
			data:{orden: kw},
			success: function(datos){
				$("#destino").val(datos.municipio+', '+datos.estado+', '+datos.pais);
				$("#direccion").val('Calle '+datos.calle+', #'+datos.num_ext+" Int."+datos.num_int+', Colonia '+datos.colonia+', Municipio '+datos.municipio+', Estado '+datos.estado+', Ciudad '+datos.ciudad+', Pais '+datos.pais);
			}
		});

	 	
	}

	function obtener_registros(busqueda,etiqueta){
		if (etiqueta == 'query'){

			$.ajax({
				url: "buscartraking",
				type: "GET",
				dataType: "html",
				data : {busqueda:busqueda},
			}).done(function(results){
				$("#datos").html(results);
			});
		}
	}
	// $("#orden_id").on('change',function(){
	// 	alert('Hola');
	// });
	$(document).on('keyup','#query',function(){
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		var valor = $(this).val();
		var etiqueta = $(this).attr('id');

		if(valor!= ""){

			obtener_registros(valor,etiqueta);
		}
		else{

			obtener_registros(' ',etiqueta);
		}
	})
</script>
@endsection