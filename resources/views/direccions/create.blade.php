{{--@extends('layouts.app')

@section('content')
    <div class="container white margin-top">
        <h1 class="color-grey font-ch">Agregar Direccion</h1>
        @include('direccions.form', ['direccion' => $direccion, 'url' => '/create', 'method' => 'POST'])
    </div>
@endsection--}}


@extends('layouts.app')

@section('content')
    <section id="four" class="wrapper style1 special fade-up">
        <div class="container">
            <header class="major">
                <h2 class="grey satisfic-font font1">Agrega tu Dirección de Envio</h2>
            </header>

        </div>
        <div class="container">


            @if ($errors->any())
                <div class="alert alert-danger text-left">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ url('/user/direccion/create') }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group col-lg-4">
                    <label for="name">Nombre:</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Nombre"
                           value="{{ old('name') }}">
                </div>

                <div class="form-group col-lg-4">
                    <label for="email">Email:</label>
                    <input type="text" class="form-control" name="email" id="email" placeholder="Email"
                           value="{{ old('email') }}"/>
                </div>

                <div class="form-group col-lg-4">
                    <label for="telefono">Telefono:</label>
                    <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Telefono"
                           value="{{ old('telefono') }}"/>
                </div>

                <div class="form-group col-lg-4">
                    <label for="contaco">Telefono del Contacto:</label>
                    <input type="text" class="form-control" name="contacto" id="contacto" placeholder="Numero del Contacto"
                           value="{{ old('contacto') }}"/>
                </div>


                <div class="form-group col-lg-4">
                    <label for="pais">País:</label>
                    <input type="text" class="form-control" name="pais" id="pais" placeholder="País"
                           value="{{ old('pais') }}"/>
                </div>

                <div class="form-group col-lg-4">
                    <label for="estado">Estado:</label>
                    <input type="text" class="form-control" name="estado" id="estado" placeholder="Estado"
                           value="{{ old('estado') }}"/>
                </div>

                <div class="form-group col-lg-4">
                    <label for="ciudad">Ciudad:</label>
                    <input type="text" class="form-control" name="ciudad" id="ciudad" placeholder="Ciudad"
                           value="{{ old('ciudad') }}"/>
                </div>

                <div class="form-group col-lg-4">
                    <label for="municipio">Municipio:</label>
                    <input type="text" class="form-control" name="municipio" id="municipio" placeholder="Municipio"
                           value="{{ old('municipio') }}"/>
                </div>

                <div class="form-group col-lg-4">
                    <label for="calle">Calle:</label>
                    <input type="text" class="form-control" name="calle" id="calle" placeholder="Calle"
                           value="{{ old('calle') }}"/>
                </div>


                <div class="form-group col-lg-2">
                    <label for="num_ext">Núm Exterior:</label>
                    <input type="text" class="form-control" name="num_ext" id="num_ext" placeholder="Número Exterior"
                           value="{{ old('num_ext') }}"/>
                </div>

                <div class="form-group col-lg-2">
                    <label for="num_int">Núm Interior:</label>
                    <input type="text" class="form-control" name="num_int" id="num_int" placeholder="Número Interior"
                           value="{{ old('num_int') }}"/>
                </div>

                <div class="form-group col-lg-2">
                    <label for="colonia">Colonia:</label>
                    <input type="text" class="form-control" name="colonia" id="colonia" placeholder="Colonia"
                           value="{{ old('colonia') }}"/>
                </div>

                <div class="form-group col-lg-2">
                    <label for="codigop">C.P:</label>
                    <input type="text" class="form-control" name="codigop" id="codigop" placeholder="Código Postal"
                           value="{{ old('codigop') }}"/>
                </div>


                <div class="form-group col-lg-4">
                    <label for="entre1">Entre Calle:</label>
                    <input type="text" class="form-control" name="entre1" id="entre1" placeholder="Entre Calle?"
                           value="{{ old('entre1') }}"/>
                </div>


                <div class="form-group col-lg-4">
                    <label for="entre2">Y Entre Calle:</label>
                    <input type="text" class="form-control" name="entre2" id="entre2" placeholder="Y Entre Calle"
                           value="{{ old('entre2') }}"/>
                </div>

                <div class="form-group col-lg-4">
                    <label for="references">Referencias Adicionales:</label>
                    <input type="text" class="form-control" name="references" id="references"
                           placeholder="Referencias Adicionales"
                           value="{{ old('references') }}"/>
                </div>

                <div class=" col-md-12 pull-center">
                    <br>
                    <a href="{{ url('/user/direccion') }}" class="btn btn-warning">Regresar</a>
                    <button type="submit" class="btn btn-primary">Guardar Dirección</button>
                </div>


            </form>

        </div>

    </section>


@endsection

