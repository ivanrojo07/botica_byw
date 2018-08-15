@extends('layouts.app')
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body grey" id="modal-body-address">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
@section('content')
	{{-- expr --}}
	<div class="container-fluid">
		<div class="panel panel-default dashadmin">
			@include('feedback')
			<div class="panel-heading">
				<h2 class="mt-4">Empaquetado</h2>
				{{-- <form name="buscar" id="buscar" method="GET" action="{{ url('') }}">
				  <div class="input-group center">
				    {{ csrf_field() }}
				    <input type="text" class="form-control" name="orden" placeholder="introduce el custom id" aria-describedby="basic-addon2" autofocus>
				    <a onclick="document.getElementById('buscar').submit()" class="input-group-addon btn btn-success" id="basic-addon2"><i class="fa fa-search"></i></a>
				  </div>
				</form> --}}
			</div>
			<div class="panel-body">
				<table class="table table-bordered tabla-status table-striped">
					<thead>
						<tr>
							<td>Id. de venta</td>
							<td>Comprador</td>
							<td>Información de envio</td>
							<td>Estatus</td>
							<td>fecha de pedido</td>
							<td>Productos</td>
							<td>Acciones</td>
						</tr>
					</thead>
					<tbody>
						@foreach ($ordenes as $orden)
							{{-- expr --}}
							<tr>
								<td>{{$orden->shoppingcart->customid}}</td>
								<td>@if ($orden->shoppingcart->user)
                                {{-- expr --}}
                                {{$orden->shoppingcart->user->name}} | {{$orden->shoppingcart->user->email}}
	                            @else
	                                INVITADO
                            	@endif</td>
                            	<td>
	                                <!-- Button trigger modal -->
	                                <button type="button" class="btn btn-success shopping_cart_address"
	                                        data-shoppingcart="{{ $orden->shopping_cart_id }}">
	                                    <i class="fa fa-eye"></i>Dirección
	                                </button>
	                            </td>
	                            <td>{{$orden->status}}</td>
	                            <td>{{$orden->updated_at}}</td>
	                            <td>
									<button type="button" class="btn btn-info infoshopping" data-shoppingcart="{{ $orden->shopping_cart_id }}">
									<i class="fa fa-eye"></i>Productos
									</button>
                                </td>
                                <td>
									<form action="{{ url('/empaquetar') }}" method="POST" id="form-verificar-orden {{ $orden->id }}" style="margin: 0px 0 1em 0;">
									{{ csrf_field() }}
	                                    <div class="checkbox">
	                                    	<label><input type="checkbox" value="{{$orden->id}}" {{$orden->empaquetado_at ? 'checked disabled' : ''}} name="verificar" id="verificar" onChange="if(confirm('desea confirmar el pedido a marzam')){this.form.submit();}else{this.checked = false}">Empaquetado</label>
	                                    </div>
	                                    {{-- <input type="radio" name="url_receta_path"
	                                           value="{{ $orden->shoppingcart->receta_path }}"/>
	                                           <label>empaquetado_at</label> --}}
	                                    {{-- <button class="btn btn-sm btn-info">empaquetado</button> --}}
	                                </form>
	                                <button type="button" {{$orden->empaquetado_at ? '' : 'disabled'}} class="btn btn-sm btn-secondary tracking_add"
										data-ordentrack="{{ $orden->id }}">
	                                    Agregar número de tracking
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection
@section('scripts')
	{{-- expr --}}
	<script>
		function verificar(etiqueta){
			if(confirm("¿Desea confirmar el empaquetado?")){
				document.getElementById("form-verificar-orden "+etiqueta).submit();
			}
		}
		$(function () {
            $(".shopping_cart_address").on('click', function (e) {
                e.preventDefault();
                var shoppingcart = $(this).data('shoppingcart');
                // acemos la peticion ajax para obtener la plantilla del carrito
                $.ajax({
					url: '{{ url('/order/info_address/') }}/' + shoppingcart,					
					type: 'GET',					
                    success: function (data) {
						$("#modal-body-address").html(data);
						$("#myModal").modal('show');
					}
				})
			});
		});		
        $(function (){
            $(".infoshopping").on('click', function(e){
                e.preventDefault();
				var shoppingcart = $(this).data('shoppingcart');				
                $.ajax({
                    url: '{{ url('/order/checkproduct') }}/'+shoppingcart,
					type: 'GET',					
                    success: function(data){
                        $('#modal-body-address').html(data);
                        $('#myModal').modal('show');
                    }
                });
            });
		});
		
        $(function (){
            $(".tracking_add").on('click', function(e){
                e.preventDefault();
                var shoppingcart = $(this).data('ordentrack');
                // console.log(shoppingcart);
                $.ajax({
                    url: '{{ url('/tracking/create/') }}/'+shoppingcart,
                    type: 'GET',
                    success: function(data){
                        $('#modal-body-address').html(data);
                        $('#myModal').modal('show');
                    }
                });
            });
        });        
	</script>
@endsection