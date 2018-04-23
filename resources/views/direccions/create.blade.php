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
                <div class="container">
                <h3 style="color: black;"><strong>*</strong> Campos requeridos</h3>
                    
                </div>

                <div class="form-group col-lg-4">

                    <label for="name"><strong>*</strong> Nombre del destinatario:</label>

                    <input type="text" class="form-control" name="name" id="name" placeholder="Nombre"

                           value="{{ old('name') }}">

                </div>



                <div class="form-group col-lg-4">

                    <label for="email"><strong>*</strong>Email:</label>

                    <input type="text" class="form-control" name="email" id="email" placeholder="Email"

                           value="{{ old('email') }}"/>

                </div>



                <div class="form-group col-lg-4">

                    <label for="telefono"><strong>*</strong>Telefono:</label>

                    <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Telefono"

                           value="{{ old('telefono') }}"/>

                </div>



                <div class="form-group col-lg-4">
                    <label for="contaco"><strong>*</strong>Telefono del destinatario:</label>

                    <input type="text" class="form-control" name="contacto" id="contacto" placeholder="Telefono"

                           value="{{ old('contacto') }}"/>

                </div>





                <div class="form-group col-lg-4">

                    <label for="pais"><strong>*</strong>País:</label>

                    {{-- <input type="text" class="form-control" name="pais" id="pais" placeholder="País"

                           value="{{ old('pais') }}"/> --}}
                    <select class="form-control" id="pais" name="pais">
                        <option value="VENEZUELA">VENEZUELA</option>
                        <option value="CUBA">CUBA</option>
                        <option value="COSTA RICA">COSTA RICA</option>
                        <option value="EL SALVADOR">EL SALVADOR</option>
                        <option value="GUATEMALA">GUATEMALA</option>
                        <option value="HONDURAS">HONDURAS</option>
                        <option value="NICARAGUA">NICARAGUA</option>
                        <option value="PANAMA">PANAMA</option>
                        <option value="COLOMBIA">COLOMBIA</option>
                        <option value="R. DOMINICANA">R. DOMINICANA</option>
                        <option value="ARGENTINA">ARGENTINA</option>
                        <option value="BOLIVIA">BOLIVIA</option>
                        <option value="CHILE">CHILE</option>
                        <option value="ECUADOR">ECUADOR</option>
                        <option value="MÉXICO">MÉXICO</option>
                        <option value="PARAGUAY">PARAGUAY</option>
                        <option value="PERU">PERU</option>
                        <option value="TRINIDAD Y TOBAGO">TRINIDAD Y TOBAGO</option>
                        <option value="URUGUAY">URUGUAY</option>
                        <option value="ARUBA">ARUBA</option>
                        <option value="BRASIL">BRASIL</option>
                        <option value="CURACAO">CURACAO</option>
                        <option value="HAITI">HAITI</option>
                        <option value="JAMAICA">JAMAICA</option>
                        <option value="SINT MAARTEN">SINT MAARTEN</option>
                        <option value="ANGUILA">ANGUILA</option>
                        <option value="ANTIGUA Y BARBUDA">ANTIGUA Y BARBUDA</option>
                        <option value="ANTILLAS HOLANDESAS">ANTILLAS HOLANDESAS</option>
                        <option value="BAHAMAS">BAHAMAS</option>
                        <option value="BARBADOS">BARBADOS</option>
                        <option value="BELICE">BELICE</option>
                        <option value="BERMUDAS">BERMUDAS</option>
                        <option value="BONAIRE">BONAIRE</option>
                        <option value="CANADA">CANADA</option>
                        <option value="DOMINICA">DOMINICA</option>
                        <option value="GRANADA">GRANADA</option>
                        <option value="GUADALUPE">GUADALUPE</option>
                        <option value="ISLAS CAIMAN">ISLAS CAIMAN</option>
                        <option value="ISLAS MARIANAS">ISLAS MARIANAS</option>
                        <option value="ISLAS MINOR">ISLAS MINOR</option>
                        <option value="ISLAS VIRG BRITANICAS">ISLAS VIRG BRITANICAS</option>
                        <option value="ISLAS VIRGINIAS AM">ISLAS VIRGINIAS AM</option>
                        <option value="MARTINICA">MARTINICA</option>
                        <option value="MONTSERRAT">MONTSERRAT</option>
                        <option value="PUERTO RICO">PUERTO RICO</option>
                        <option value="ROAD TOWN ARPT">ROAD TOWN ARPT</option>
                        <option value="ROOSEVELT FIELD">ROOSEVELT FIELD</option>
                        <option value="SANTA LUCIA">SANTA LUCIA</option>
                        <option value="SANTA LUCIA">SANTA LUCIA</option>
                        <option value="ST JEAN ARPT">ST JEAN ARPT</option>
                        <option value="ST THOMAS">ST THOMAS</option>
                        <option value="ST BARTOLOME">ST BARTOLOME</option>
                        <option value="ST KITTS">ST KITTS</option>
                        <option value="ST VINCENT">ST VINCENT</option>
                        <option value="TURCAS Y CAICOS">TURCAS Y CAICOS</option>
                        <option value="WALLIS FORTUNA">WALLIS FORTUNA</option>

                    </select>

                </div>



                <div class="form-group col-lg-4">

                    <label for="estado"><strong>*</strong>Estado o Población:</label>

                    <input type="text" class="form-control" name="estado" id="estado" placeholder="Estado o Poblacion"

                           value="{{ old('estado') }}"/>

                </div>



                <div class="form-group col-lg-4">

                    <label for="ciudad"><strong>*</strong>Ciudad</label>

                    <input type="text" class="form-control" name="ciudad" id="ciudad" placeholder="Ciudad"

                           value="{{ old('ciudad') }}"/>

                </div>



                <div class="form-group col-lg-4">

                    <label for="municipio"><strong>*</strong>Municipio:</label>

                    <input type="text" class="form-control" name="municipio" id="municipio" placeholder="Municipio"

                           value="{{ old('municipio') }}"/>

                </div>



                <div class="form-group col-lg-4">

                    <label for="calle"><strong>*</strong>Calle:</label>

                    <input type="text" class="form-control" name="calle" id="calle" placeholder="Calle"

                           value="{{ old('calle') }}"/>

                </div>





                <div class="form-group col-lg-2">

                    <label for="num_ext"><strong>*</strong>Número Exterior:</label>

                    <input type="text" class="form-control" name="num_ext" id="num_ext" placeholder="Número Exterior"

                           value="{{ old('num_ext') }}"/>

                </div>



                <div class="form-group col-lg-2">

                    <label for="num_int">Número Interior:</label>

                    <input type="text" class="form-control" name="num_int" id="num_int" placeholder="Número Interior"

                           value="{{ old('num_int') }}"/>

                </div>



                <div class="form-group col-lg-2">

                    <label for="colonia"><strong>*</strong>Colonia:</label>

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



