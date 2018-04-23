{!! Form::open(['url' => $url, 'method' => $method, 'files' => true]) !!}

    <div class="container">

      <div class="form-group">

      {{ Form::text('title', $direccion->name, ['class' => 'form-control', 'placeholder'=>'Titulo....']) }}

    </div>

    <div class="form-group">

      {{ Form::text('calle', $direccion->calle, ['class' => 'form-control', 'placeholder'=>'Categoria del producto....']) }}

    </div>

    <div class="form-group">

      {{ Form::text('num_ext', $direccion->num_ext, ['class' => 'form-control', 'placeholder'=>'Categoria del producto....']) }}

    </div>

    <div class="form-group">

      {{ Form::text('num_int', $direccion->num_int, ['class' => 'form-control', 'placeholder'=>'Categoria del producto....']) }}

    </div>

    <div class="form-group">

      {{ Form::text('entre1', $direccion->entre1, ['class' => 'form-control', 'placeholder'=>'Categoria del producto....']) }}

    </div>

    <div class="form-group">

      {{ Form::text('entre2', $direccion->entre2, ['class' => 'form-control', 'placeholder'=>'Categoria del producto....']) }}

    </div>

    <div class="form-group">

      {{ Form::textarea('references', $direccion->references, ['class' => 'form-control', 'placeholder'=>'Categoria del producto....']) }}

    </div>

    <div class="form-group">

      {{ Form::text('codigop', $direccion->codigop, ['class' => 'form-control', 'placeholder'=>'Categoria del producto....']) }}

    </div>

    <div class="form-group">

      {{ Form::text('colonia', $direccion->colonia, ['class' => 'form-control', 'placeholder'=>'Categoria del producto....']) }}

    </div>

   <div class="form-group">

      {{ Form::text('estado', $direccion->estado, ['class' => 'form-control', 'placeholder'=>'Categoria del producto....']) }}

    </div>

    <div class="form-group">

      {{ Form::text('municipio', $direccion->municipio, ['class' => 'form-control', 'placeholder'=>'Categoria del producto....']) }}

    </div>

    <div class="form-group">

      {{ Form::text('ciudad', $direccion->ciudad, ['class' => 'form-control', 'placeholder'=>'Categoria del producto....']) }}

    </div>

    <div class="form-group">
      {{ Form::select('pais', array(
        'Costa Rica' => 'COSTA RICA',
        'El Salvador' => 'EL SALVADOR',
        'Guatemala'=>'GUATEMALA',
        'Honduras'=>"HONDURAS",
        'Nicaragua'=>"NICARAGUA",
        'Panama'=>'PANAMA'

         ),'')}}
      {{-- {{ Form::text('pais', $direccion->pais, ['class' => 'form-control', 'placeholder'=>'Categoria del producto....']) }} --}}
      }

    </div>

    <div class="form-group">

      {{ Form::text('status', $direccion->status, ['class' => 'form-control', 'placeholder'=>'Categoria del producto....']) }}

    </div>

    <div class="form-group">

      {{ Form::text('guide_numer', $direccion->gui_numer, ['class' => 'form-control', 'placeholder'=>'Categoria del producto....']) }}

    </div>

    <div class="form-group text-right">

      <input type="submit" value="Enviar" class="btn btn-success">

      <button onclick="window.location.href='{{url('/user')}}'" type="button" class="btn btn-primary">Regresar</button>



    </div>

    </div>

{!! Form::close() !!}