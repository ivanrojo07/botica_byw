@extends('layouts.app')
@section('content')
	<div class="container-fluid">
		<div class="card card-default mt-2 mb-2">
			<div class="card-header">
				<h4>Dirección para pedido #{{$pedido->id}}</h4>
			</div>
			<div class="card-body">
				<table class="table table-hover table-bordered table-striped table-dark">
					<thead>
						<tr class="text-center">
							<th scope="col">Producto</th>
							<th scope="col">Cantidad</th>
							<th scope="col">Precio unitario</th>
							<th scope="col">Total</th>
							<th scope="col">Peso Aprox</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($pedido->products as $producto)
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
								<td class="text-center">
									{{$producto->peso['peso']." ".$producto->peso['medida']}}
								</td>
							</tr>
						@endforeach
						<tr id="envio">
							@if ($pedido->totalenvio != 0.00)
								<td class="text-center">
									Envio
								</td>
								<td></td>
								<td></td>
								<td class="text-center">
									$ {{$pedido->totalenvio}} USD
								</td>
								<td class="text-center">
									
								</td>
							@endif
						</tr>
						<tr>
							<td class="text-center">
								Total
							</td>
							<td></td>
							<td></td>
							<td class="text-center" >
								$ 
								<b id="precio_total">
									{{$pedido->total+$pedido->totalenvio}}	
								</b>
								USD
							</td>
							<td class="text-center">
								{{$pedido->peso['peso']." ".$pedido->peso['medida']}}
							</td>
						</tr>
					</tbody>
				</table>
				<form method="POST" action="{{ $edit ? route('pedidos.direccions.update',['pedido'=>$pedido,'direccion'=>$direccion]) : route('pedidos.direccions.store',['pedido'=>$pedido]) }}">
					{{csrf_field()}}
					@if ($edit)
						<input type="hidden" name="_method" value="PUT">
					@endif
					@if ($errors->any())
		                <div class="alert alert-danger text-left">
		                    <ul>
		                        @foreach ($errors->all() as $error)
		                            <li>{{ $error }}</li>
		                        @endforeach
		                    </ul>
		                </div>
		            @endif
					<div class="row form-group">
						<div class="col-12 mb-2">
							<h3>
								Datos de la dirección del envio
								<small class="text-muted">* Campos requeridos</small>
							</h3>
						</div>
						<div class="col-4 mb-2">
		                    <label for="telefono"><strong>*</strong> Telefono del remitente (quien envia):</label>
		                        <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Telefono" value="{{ $edit ? $direccion->telefono : $pedido->contacto->codigo_pais.' '.$pedido->contacto->telefono }}" required/>
		                </div>
						<div class="col-4 mb-2">
							<label for="calle" class="control-label">
								<strong>*</strong> Calle
							</label>
							<input type="text" class="form-control" name="calle" placeholder="Calle" value="{{$edit ? $direccion->calle : old('calle')}}" required>
						</div>
						<div class="col-2 mb-2">
							<label for="num_ext" class="control-label">
								<strong>*</strong> Número exterior
							</label>
							<input type="text" class="form-control" name="num_ext" placeholder="#" value="{{$edit ? $direccion->num_ext : old('num_ext')}}" required>
						</div>
						<div class="col-2 mb-2">
							<label for="num_int" class="control-label">
								Número interior
							</label>
							<input type="text" class="form-control" name="num_int" placeholder="Int." value="{{$edit ? $direccion->num_int : old('num_int')}}">
						</div>
						<div class="col-4 mb-2" id="div_colonia">
							<label for="colonia" class="control-label">
								Colonia ó localidad
							</label>
							<input type="text" class="form-control" name="colonia" placeholder="Colonia o población ó localidad" value="{{$edit ? $direccion->colonia : old('colonia')}}">
						</div>
						<div class="col-4 mb-2" id="codigo_postal">
							<label for="codigop" class="control-label">
								Código postal o Zip Code (altamente recomendable)
							</label>
							<input type="text" class="form-control" name="codigop" placeholder="C.P. ó Zip Code" value="{{$edit ? $direccion->codigop : old('codigop')}}">
						</div>
						<div class="col-4 mb-2">
							<label for="estado" class="control-label">
								<strong>*</strong> Estado ó provincia ó departamento
							</label>
							<input type="text" class="form-control" name="estado" placeholder="Estado ó provincia ó departamento" value="{{$edit ? $direccion->estado : old('estado')}}">
						</div>
						<div class="col-4 mb-2">
							<label for="municipio" class="control-label">
								<strong>*</strong> Municipio ó población
							</label>
							<input type="text" class="form-control" name="municipio" placeholder="Municipio ó población" value="{{$edit ? $direccion->municipio : old('municipio')}}" required="">
						</div>
						<div class="col-4 mb-2">
							<label for="ciudad" class="control-label">
								<strong>*</strong> Ciudad
							</label>
							<input type="text" class="form-control" name="ciudad" placeholder="Ciudad" value="{{$edit ? $direccion->ciudad : old('ciudad')}}" required="">
						</div>
						<div class="col-4 mb-2">
							<label for="pais" class="control-label">
								<strong>*</strong> País
							</label>
							<select class="form-control" id="pais" name="pais" required>
								<option value="">Seleccione el país de envio</option>
								@foreach ($countries as $country)
									<option value="{{$country->name}}" 
										@if ($edit && $country->name == $direccion->pais )
											selected 
										@elseif(old('pais') == $country->name )
											selected 
										@endif>
										{{$country->nicename}}
									</option>
								@endforeach
							</select>
						</div>
						<div class="col-8 mb-2">
							<label for="entre" class="control-label">Entre calles</label>
							<div class="input-group mb-3">
						  		<input type="text" class="form-control" name="entre1" value="{{$edit ? $direccion->entre1 : old('entre1')}}" placeholder="Calle 1" aria-describedby="basic-addon2">
							  	<div class="input-group-append">
							    	<span class="input-group-text" id="basic-addon2">y calle</span>
							  	</div>
							  	<input type="text" class="form-control" name="entre2" value="{{$edit ? $direccion->entre2 : old('entre2')}}" placeholder="Calle 2" aria-describedby="basic-addon2">
							</div>
						</div>
						<div class="col-4 mb-2">
							<label for="" class="control-label">Referencia adicional</label>
							<textarea name="references" id="references" cols="30" rows="3" class="form-control" placeholder="Color de la casa, número de pisos, etc">{{$edit ? $direccion->references : old('references')}}</textarea>
						</div>
					</div>
					<div class="row form-group">
						<div class="col-12 mb-2">
							<h3>
								Datos de contacto de envio
								<small class="text-muted">* Campos requeridos</small>
							</h3>
						</div>
						<div class="col-4 mb-2">
							<label for="name" class="control-label">
								<strong>*</strong> Nombre del destinatario (quien reciba)
							</label>
							<input type="text" name="name" class="form-control" placeholder="Nombre completo del quien recibira la orden" value="{{$edit ? $direccion->name : old('name')}}" required>
						</div>
						<div class="col-4 mb-2">
							<label for="email" class="control-label"><strong>*</strong>Correo electronico del destinatario (quien reciba)</label>
							<input type="email" class="form-control" name="email" placeholder="Correo electronico del quien recibira la orden" value="{{$edit ? $direccion->email : old('email')}}" required="">
						</div>
						<div class="col-4 mb-2">
							<label for="contacto" class="control-label"><strong>*</strong>Telefono del destinatario (quien reciba)</label>
							<div class="input-group mb-3">
								<div class="input-group-prepend w-25">
									<input type="text" class="form-control" id="lada" name="lada" placeholder="Código" value="{{old('lada')}}" readonly>
								</div>
								<input type="text" class="form-control" placeholder="Telefono" name="contacto" value="{{$edit ? $direccion->contacto : old('contacto')}}" required="">
							</div>
						</div>
					</div>
					<div class="row form-group">
						<div class="col-12 mb-2">
							<h3>
								Datos del pedido
								<small class="text-muted">* Campos requeridos</small>
							</h3>
						</div>
						<div class="col-4 mb-2">
							<label for="contacto" class="control-label"><strong>*</strong>Peso aproximado del pedido (agregar si hay productos sin definir el peso)</label>
							<div class="input-group mb-3">
								<input type="number" class="form-control" placeholder="Peso" id="peso" name="peso" value="{{$edit ? $pedido->peso['peso'] : $pedido->peso['peso']}}" step="any">
								<div class="input-group-append w-25">
									<span class="input-group-text" id="basic-addon2">Kilogramos</span>
								</div>
							</div>
						</div>
						<div class="col-4 mb-2">
							<label for="contacto" class="control-label"><strong>*</strong>Precio de envio</label>
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon2">$</span>
								</div>
								<input type="number" class="form-control" placeholder="Seleccione el pais de envio" id="precio" name="envio" value="{{$edit ? $pedido->totalenvio : old('envio')}}" readonly="">
								<div class="input-group-append w-25">
									<span class="input-group-text" id="basic-addon2">USD</span>
								</div>
							</div>
						</div>
					</div>
					<div class="d-flex justify-content-center">
	                    <button type="submit" class="btn btn-primary"> <i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar Dirección</button>
	                </div>
				</form>
			</div>
		</div>
	</div>
@endsection
@section('scripts')
	<script type="text/javascript">
        $(document).ready(function(){
           $("#pais").change(function() {
               // body...
               $.ajaxSetup(
				{
				    headers:
				    {
				        'X-CSRF-Token': $('input[name="_token"]').val()
				    }
				});
               pais = $('#pais').val()
               $.get('{{ url('/getPais') }}/'+pais,function (data) {
                   // body...
                   // console.log(data);
                   if (data.pais.name == "CUBA") {
                    $("#codigo_postal").hide();
                    $("#div_colonia").hide();
                   }
                   else{
                     $("#codigo_postal").show();
                    $("#div_colonia").show();
                   }
                   $('#lada').empty();
                   $('#lada').val(data.pais.phonecode);

               });
               peso = $('#peso').val();
               $.post('{{ url('/envioshopping') }}',{pais:pais,peso:peso},function(data,status){
               	var rowEnvio = `
               	<td class="text-center">
					Envio
				</td>
				<td></td>
				<td></td>
				<td class="text-center">
					$ ${data.precio} USD
				</td>
				<td class="text-center">
					
				</td>
               	`;
               	total = {{$pedido->total}}+ +data.precio;
               	// console.log(total);
               	$("#precio_total").html(total.toFixed(2));
               	$("#envio").empty();
               	$("#envio").append(rowEnvio);
               	$("#precio").empty();
               	$("#precio").val(data.precio);
               })
           });
           $("#peso").change(function() {
               // body...
               $.ajaxSetup(
				{
				    headers:
				    {
				        'X-CSRF-Token': $('input[name="_token"]').val()
				    }
				});
               pais = $('#pais').val()
               $.get('{{ url('/getPais') }}/'+pais,function (data) {
                   // body...
                   // console.log(data);
                   if (data.pais.name == "CUBA") {
                    $("#codigo_postal").hide();
                    $("#div_colonia").hide();
                   }
                   else{
                     $("#codigo_postal").show();
                    $("#div_colonia").show();
                   }
                   $('#lada').empty();
                   $('#lada').val(data.pais.phonecode);

               });
               peso = $('#peso').val();
               $.post('{{ url('/envioshopping') }}',{pais:pais,peso:peso},function(data,status){
               	// console.log('data',data);
               	// console.log('status',status);
               	var rowEnvio = `
               	<td class="text-center">
					Envio
				</td>
				<td></td>
				<td></td>
				<td class="text-center">
					$ ${data.precio} USD
				</td>
				<td class="text-center">
					
				</td>
               	`;
               	total = {{$pedido->total}}+ +data.precio;
               	$("#precio_total").text(total.toFixed(2));
               	$("#envio").empty();
               	$("#envio").append(rowEnvio);
               	$("#precio").empty();
               	$("#precio").val(data.precio);
               })
           });
        });
    </script>
@endsection