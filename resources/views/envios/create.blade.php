@extends('layouts.app')
@section('content')
	{{-- expr --}}
	<section id="four" class="wrapper style1 special fade-up">
        <div id="productos" class="container">
        	{{-- <div class="jumbotron"> --}}
			  <h4 style="color: black;">Zona de envios</h4>
			  	@if ($errors->any())
	                <div class="alert alert-danger text-left">
	                    <ul>
	                        @foreach ($errors->all() as $error)
	                            <li>{{ $error }}</li>
	                        @endforeach
	                    </ul>
	                </div>
	            @endif
			  <form action=@if ($edit)
			  	{{-- true expr --}}
			  	"{{ route('envios.update',['envio'=>$envio]) }}"
			  @else
			  	{{-- false expr --}}
			  	"{{ route('envios.store') }}"
			  @endif method="POST" name="envioform">
			  	@if ($edit)
			  		{{-- true expr --}}
			  		<input type="hidden" name="_method" value="PUT">
			  		<input type="hidden" name="id" value="{{$envio->id}}">
			  	@endif
			  	{{ csrf_field() }}
			  	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 form-group">
			  		<label for="peso">Peso:</label>
			  		<div class="input-group">
					 	<input style="color: black;" class="form-control" type="number" @if ($edit)
					 		{{-- true expr --}}
					 		value="{{$envio->peso}}"
					 	@else
					 		{{-- false expr --}}
					 		value="{{ old('peso') }}"
					 	@endif name="peso" id="peso" step="0.50" min="0.50" max="30" autofocus>
					  <span class="input-group-addon">Kg.</span>
					</div>
			  	</div>

			  	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 form-group">
			  		<label for="precio_a">Precio Zona A:</label>
			  		<div class="input-group">
			  			<span class="input-group-addon">$</span>
					 	<input style="color: black;" class="form-control" type="number" @if ($edit)
					 		{{-- true expr --}}
					 		value="{{$envio->precio_a}}"
					 	@else
					 		{{-- false expr --}}
					 		value="{{ old('precio_a') }}"
					 	@endif name="precio_a" id="precio_a" step="0.01" min="0.01">
					  	<span class="input-group-addon">USD</span>
					</div>	
			  	</div>

			  	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 form-group">
			  		<label for="precio_b">Precio Zona B:</label>
			  		<div class="input-group">
			  			<span class="input-group-addon">$</span>
					 	<input style="color: black;" class="form-control" type="number" @if ($edit)
					 		{{-- true expr --}}
					 		value="{{$envio->precio_b}}"
					 	@else
					 		{{-- false expr --}}
					 		value="{{ old('precio_b') }}"
					 	@endif name="precio_b" id="precio_b" step="0.01" min="0.01">
					  	<span class="input-group-addon">USD</span>
					</div>	
			  	</div>

			  	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 form-group">
			  		<label for="precio_c">Precio Zona C:</label>
			  		<div class="input-group">
			  			<span class="input-group-addon">$</span>
					 	<input style="color: black;" class="form-control" type="number" @if ($edit)
					 		{{-- true expr --}}
					 		value="{{$envio->precio_c}}"
					 	@else
					 		{{-- false expr --}}
					 		value="{{ old('precio_c') }}"
					 	@endif name="precio_c" id="precio_c" step="0.01" min="0.01">
					  	<span class="input-group-addon">USD</span>
					</div>	
			  	</div>

			  	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 form-group">
			  		<label for="precio_d">Precio Zona D:</label>
			  		<div class="input-group">
			  			<span class="input-group-addon">$</span>
					 	<input style="color: black;" class="form-control" type="number" @if ($edit)
					 		{{-- true expr --}}
					 		value="{{$envio->precio_d}}"
					 	@else
					 		{{-- false expr --}}
					 		value="{{ old('precio_d') }}"
					 	@endif name="precio_d" id="precio_d" step="0.01" min="0.01">
					  	<span class="input-group-addon">USD</span>
					</div>	
			  	</div>
			  	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 form-group">
			  		<label for="precio_e">Precio Zona E:</label>
			  		<div class="input-group">
			  			<span class="input-group-addon">$</span>
					 	<input style="color: black;" class="form-control" type="number" @if ($edit)
					 		{{-- true expr --}}
					 		value="{{$envio->precio_e}}"
					 	@else
					 		{{-- false expr --}}
					 		value="{{ old('precio_e') }}"
					 	@endif name="precio_e" id="precio_e" step="0.01" min="0.01">
					  	<span class="input-group-addon">USD</span>
					</div>	
			  	</div>
			  	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 form-group">
			  		<label for="precio_f">Precio Zona F:</label>
			  		<div class="input-group">
			  			<span class="input-group-addon">$</span>
					 	<input style="color: black;" class="form-control" type="number" @if ($edit)
					 		{{-- true expr --}}
					 		value="{{$envio->precio_f}}"
					 	@else
					 		{{-- false expr --}}
					 		value="{{ old('precio_f') }}"
					 	@endif name="precio_f" id="precio_f" step="0.01" min="0.01">
					  	<span class="input-group-addon">USD</span>
					</div>	
			  	</div>
			  	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 form-group">
			  		<label for="precio_g">Precio Zona G:</label>
			  		<div class="input-group">
			  			<span class="input-group-addon">$</span>
					 	<input style="color: black;" class="form-control" type="number" @if ($edit)
					 		{{-- true expr --}}
					 		value="{{$envio->precio_g}}"
					 	@else
					 		{{-- false expr --}}
					 		value="{{ old('precio_g') }}"
					 	@endif name="precio_g" id="precio_g" step="0.01" min="0.01">
					  	<span class="input-group-addon">USD</span>
					</div>	
			  	</div>
			  	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 form-group">
			  		<label for="precio_h">Precio Zona H:</label>
			  		<div class="input-group">
			  			<span class="input-group-addon">$</span>
					 	<input style="color: black;" class="form-control" type="number" @if ($edit)
					 		{{-- true expr --}}
					 		value="{{$envio->precio_h}}"
					 	@else
					 		{{-- false expr --}}
					 		value="{{ old('precio_h') }}"
					 	@endif name="precio_h" id="precio_h" step="0.01" min="0.01">
					  	<span class="input-group-addon">USD</span>
					</div>	
			  	</div>
			  	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 form-group">
			  		<label for="precio_i">Precio Zona I:</label>
			  		<div class="input-group">
			  			<span class="input-group-addon">$</span>
					 	<input style="color: black;" class="form-control" type="number" @if ($edit)
					 		{{-- true expr --}}
					 		value="{{$envio->precio_i}}"
					 	@else
					 		{{-- false expr --}}
					 		value="{{ old('precio_i') }}"
					 	@endif name="precio_i" id="precio_i" step="0.01" min="0.01">
					  	<span class="input-group-addon">USD</span>
					</div>	
			  	</div>
			  	<div class="col-lg-12">
			  		<input type="submit" value="Guardar" title="Guardar" class="btn btn-success">
			  	</div>
			  </form>
			{{-- </div> --}}
        </div>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
    </section>
@endsection