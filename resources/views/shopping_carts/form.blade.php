@include('feedback')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{ url('carrito') }}" method="POST" class="inline-block" enctype='multipart/form-data'>
    {{ csrf_field() }}
    {{-- @if($direcctions != "")
        <div class="form-group">
            <label><strong>Dirección de envio:</strong></label>
            @foreach ($direcctions as $direccion)
                <div class="radio">
                    <label><input type="radio" name="direccion_default" value="{{$direccion->id}}" @if ($direccion->default == 1)
                        checked
                    @endif><strong>Nombre:</strong> {{$direccion->name}}, <strong>País:</strong> {{$direccion->pais}}, <strong>Estado y Municipio:</strong> {{$direccion->estado}}, {{$direccion->municipio}} ,<strong>Calle y Número:</strong> {{$direccion->calle}}, #Exterior. {{$direccion->num_ext}}, #Interior. @if ($direccion->num_int == null)
                        S/N
                    @else
                        {{$direccion->num_int}}
                    @endif , <strong>Colonia:</strong> {{$direccion->colonia}}, <strong>C.P.:</strong> @if ($direccion->codigop == null)
                        S/C
                    @else
                        {{$direccion->codigop}}
                    @endif , <strong>Entre calles:</strong> @if ($direccion->entre1 == null)
                        Información no agregada
                    @else
                        {{$direccion->entre1}} 
                    @endif y @if ($direccion->entre2 == null)
                        Información no agregada
                    @else
                        {{$direccion->entre2}} 
                    @endif, <strong>Referencia adicional:</strong> @if ($direccion->references == null)
                        Sin Referencia adicional
                    @else
                        {{$direccion->references}}
                    @endif</label>
                    <br>
                </div>
            @endforeach
        </div>
        <br/>
    @elseif(Auth::check() && $direcctions == "")
        <div class="form-group">
            <div class="alert alert-danger">
              <strong>¡Importante!</strong> Antes de continuar por favor ingrese sus datos de envio.</a>.
            </div>
            <label for="">Si no has establecido tus datos de envio favor de ingresar al siguiente <a class="btn btn-sm btn-success" href="{{ url('/user/direccion') }}">link</a></label>
        </div>
    @elseif($direccion_default != "")
            <div class="form-group">
            <input type="hidden" name="direccion_default" value="{{ $direccion_default->id }}"/>
            <label for="">
               <strong>La direccion que colocaste predeterminada es:</strong>
            </label>
            <table class="table table-responsive-md">
                <thead>
                <tr>
                    <td>Nombre</td>
                    <td>Email</td>
                    <td>País</td>
                    <td>Estado, Municipio</td>
                    <td>Calle, Número</td>
                    <td>Colonia</td>
                    <td>C.P</td>
                    <td>Entre Calles</td>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        {{ $direccion_default->name }}
                    </td>
                    <td>
                        {{ $direccion_default->email }}
                    </td>
                    <td>
                        {{ $direccion_default->pais }}
                    </td>
                    <td>
                        {{ $direccion_default->estado . ', ' . $direccion_default->municipio }}
                    </td>
                    <td>
                        {{ $direccion_default->calle . ', Ext:' . $direccion_default->num_ext . ', Int:' . $direccion_default->num_int  }}
                    </td>
                    <td>
                        {{ $direccion_default->colonia }}
                    </td>
                    <td>
                        {{ $direccion_default->codigop }}
                    </td>
                    <td>
                        {{ $direccion_default->entre1 . ' Y ' . $direccion_default->entre2}}
                    </td>
                    <td>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    @else
        <div class="form-group">
        <div class="alert alert-danger">
          <strong>¡Importante!</strong> Antes de continuar por favor ingrese sus datos de envio.</a>.
        </div>
        <label for="">Si no has establecido tus datos de envio favor de ingresar al siguiente <a class="btn btn-sm btn-success" href="{{ url('/creardireccion') }}">link</a></label>
        </div>
    @endif --}}
    <div class="row mt-1 mb-1">
        <h4 class="title">Ayudanos a terminar su compra agregando algunos datos de contacto.</h4>
    </div>
    <div class="row mt-2 mb-2">
        <div class="col-3 form-group">
            <label class="control-label">
                Nombre:
            </label>
            <input type="text" class="form-control" name="nombre" value="{{Auth::user() ? Auth::user()->name : ''}}" required>
        </div>
        <div class="col-3 form-group">
            <label class="control-label">
                email:
            </label>
            <input type="text" class="form-control" name="email" value="{{Auth::user() ? Auth::user()->email : ''}}" required>
        </div> 
        <div class="col-6 form-group">
            <label class="control-label">
                Teléfono:
            </label>
            <div class="input-group-prepend">
                <select class="col-4 form-control" id="codigo_pais" name="codigo_pais" required>
                    <option value="">código de su país</option>
                    @foreach ($countries as $country)
                        <option value="{{$country->phonecode}}">{{$country->iso3." ".$country->phonecode}}</option>
                    @endforeach
                </select>
                <input type="text" class="col-8 form-control" name="telefono" placeholder="Número telefonico" pattern="[0-9]{8,15}" title="Sólo incluir digitos numericos con longitud máxima de 15">
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for=""><strong>Selecciona el archivo de tu receta en formato (pdf, jpg, png o jpeg):</strong></label>
        <input id="receta" name="receta_file" type="file" class="file">
        {{-- <input class="btn btn-primary" type="file" name="receta_file" value="" placeholder="receta"/> --}}
    </div>
 {{-- @if (Auth::guest())
        if
                   <label class=""> <strong>Inicia session para administrar tus direcciones.</strong></label>
 @else --}}
 {{--    @endif --}}
    @if($total > 0)
        <input type="submit" class="btn btn-success special Special" value="Terminar compra">
    @endif
</form>
{{--{!!Form::open(['url' => '/carrito', 'method' => 'POST', 'class'=>"inline-block"])!!}
{!!Form::close()!!}--}}
<br>
<br><br><br>
