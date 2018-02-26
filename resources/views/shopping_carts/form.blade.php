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

   

    <div class="form-group">

        <label for=""><strong>Selecciona el archivo de tu receta en formato (pdf, jpg, png o jpeg):</strong></label>
        <input id="receta" name="receta_file" type="file" class="file">
            
        {{-- <input class="btn btn-primary" type="file" name="receta_file" value="" placeholder="receta"/> --}}

    </div>

 {{-- @if (Auth::guest())
        if
                   <label class=""> <strong>Inicia session para administrar tus direcciones.</strong></label>

 @else --}}

    @if($direccion_default)

        <div class="form-group">

            <input type="hidden" name="direccion_default" value="{{ $direccion_default->id }}"/>

            <label for="">

               <strong>La direccion que colocaste predeterminada es:</strong>

            </label>



            <table class="table">

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

        <br/>

        

        @else

        <div class="form-group">
        <div class="alert alert-danger">
          <strong>¡Importante!</strong> Antes de continuar por favor ingrese sus datos de envio.</a>.
        </div>
        <label for="">Si no has establecido tus datos de envio favor de ingresar al siguiente <a class="btn btn-sm btn-success" href="{{ url('/creardireccion') }}">link</a></label>

    </div>

    

    @endif

 {{--    @endif --}}

    @if($total > 0)

        <input type="submit" class="btn btn-success special Special" value="Pagar con Paypal">

    @endif



</form>

{{--{!!Form::open(['url' => '/carrito', 'method' => 'POST', 'class'=>"inline-block"])!!}

{!!Form::close()!!}--}}

<br>

<br><br><br>