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