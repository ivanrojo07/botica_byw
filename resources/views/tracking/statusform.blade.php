
<div class="panel-header">
	<br>
	<br>
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
				<div class="col-sm-3">   
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
		   	</tr>
		 @endforeach
		</tbody>
	</table>
</div>
