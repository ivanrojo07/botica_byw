
	<h4 class="modal-title grey" id="myModalLabel">
		Nuevo Tracking:
	</h4>
	<div class="col-lg-12">
		<form method="POST" action="{{ route('tracking.store') }}">
			{{ csrf_field() }}
			<div class="modal-body">
				<div class="row">
					<div class="col-sm-6">
						<label for="hawb">HAWB:</label>
						<input type="text" class="form-control" name="hawb" id="hawb" placeholder="Clave HAWB" required>
					</div>
					<div class="col-sm-6">
						<label for="orden_id">Orden de Compra:</label>
						<select class="form-control" id="orden_id" name="orden_id" required readonly>
							<option value="{{$orden->id}}" selected>{{$shopping_cart->customid}}</option>
						</select>
					</div>
					<div class="col-sm-offset-1 col-sm-10">
						<label for="destino">Destino:</label>
						<input class="form-control" type="text" name="destino" id="destino" placeholder="Destino" required value="{{ $direccion->municipio }}, {{$direccion->estado}}, {{$direccion->pais}}">
					</div>
					<div class="col-sm-6">
						<label for="bultos">Número de Bultos</label>
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
					<div class="col-sm-6">
						<label for="peso">Peso:</label>
						<input class="form-control" type="number" name="peso" id="peso" step="0.50" min="0.50" max="30" placeholder="-Kg-" required>
					</div>
					<div class="col-sm-offset-1 col-sm-10">
						<textarea class="form-control" readonly="readonly" id="direccion" rows="8">Calle {{ $direccion->calle }}, #{{$direccion->num_ext}} {{$direccion->num_int ? "Int $direccion->num_int," : ","}} Colonia {{$direccion->colonia}}, Municipio {{$direccion->municipio}}, Estado {{$direccion->estado}}, Ciudad {{$direccion->ciudad}}, País {{$direccion->pais}} </textarea>
					</div>
				</div>
			</div>
			<input type="submit" class="btn btn-success pull-right" value="Guardar">
		</form>
	</div>
