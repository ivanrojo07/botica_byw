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
				<h2>Pedidos a Marzam</h2>
				{{-- <form name="buscar_tracking" id="buscar_tracking" method="GET" action="{{ url('/buscartracking') }}">
				  <div class="input-group center">
				    {{ csrf_field() }}
				    <input type="text" class="form-control" name="tracking" placeholder="introduce el custom id" aria-describedby="basic-addon2" autofocus>
				    <a onclick="document.getElementById('buscar_tracking').submit()" class="input-group-addon btn btn-success" id="basic-addon2"><i class="fa fa-search"></i></a>
				  </div>
				</form> --}}
			</div>
			<div class="panel-body">
				<table class="table table-responsive table-bordered tabla-status table-striped">
					<thead>
						<tr>
							<td>Id de venta</td>
							<td>Comprador</td>
							<td>Destinatario</td>
							<td>Dirección</td>
							<td>Estatus</td>
							<td>Fecha de Venta</td>
							<td>Carrito de compra</td>
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
                            	<td>{{ $orden->recipient_name }}</td>
                            	<td>
	                                <!-- Button trigger modal -->
	                                <button type="button" class="btn btn-success shopping_cart_address"
	                                        data-shoppingcart="{{ $orden->shopping_cart_id }}">
	                                    <i class="fa fa-eye"></i>Dirección
	                                </button>
	                            </td>
	                            <td>{{$orden->status}}</td>
	                            <td>{{ $orden->created_at }}</td>
	                            <td><button type="button" class="btn btn-info infoshopping" data-shoppingcart="{{ $orden->shopping_cart_id }}">
                                    <i class="fa fa-eye"></i>Productos
                                </button>
                                </td>
                                <td>
                                	<form action="{{ url('/marzam_verificado') }}" method="POST" id="form-verificar-orden {{ $orden->id }}" style="margin: 0px 0 1em 0;">
	                                    {{ csrf_field() }}
	                                    <div class="checkbox">
	                                    	<label><input type="checkbox" value="{{$orden->id}}" {{$orden->verificado ? 'checked disabled' : ''}} name="verificar" id="verificar" onChange="if(confirm('desea confirmar el pedido a marzam')){this.form.submit();}else{this.checked = false}">Verificado</label>
	                                    </div>
	                                    {{-- <input type="radio" name="url_receta_path"
	                                           value="{{ $orden->shoppingcart->receta_path }}"/>
	                                           <label>verificado</label> --}}
	                                    {{-- <button class="btn btn-sm btn-info">Verificado</button> --}}
	                                </form>
	                                <form {{$orden->verificado ? 'disabled' : ''}} id="orden {{ $orden->id }}" action="{{ route('reenviar_orden') }}" method="POST" style="margin: 0px 0 1em 0;">
	                                    {{ csrf_field() }}
	                                    <input type="hidden" name="orden"
	                                           value="{{ $orden->id }}"/>
	                                    <a type="submit" {{$orden->verificado ? 'disabled' : ''}}  @if ($orden->verificado == 0)
	                                    	{{-- expr --}}
	                                    	onclick="deleteFunction('orden {{ $orden->id }}')"
	                                    @endif  class='btn btn-sm btn-secondary text-white {{$orden->verificado ? "disabled" : ""}}'>Reenviar Orden
	                                     de <br> Compra</a>
	                                </form>
                                </td>
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
		function deleteFunction(etiqueta) {
            event.preventDefault(); // prevent form submit
            if (confirm("¿Deseas reenviar tu pedido a marzam?")){
                document.getElementById(etiqueta).submit();          // submitting the form when user press yes
            }
        }
		function verificar(etiqueta){
			if(confirm("¿Desea confirmar la verificación de este pedido a marzam?")){
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
                    url: '{{ url('/order/info_shopping') }}/'+shoppingcart,
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