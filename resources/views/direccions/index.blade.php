@extends('layouts.app')



@section('content')

    <section id="four" class="wrapper style1 special fade-up">

        <div class="container">

            <header class="major">

                <h2 class="grey satisfic-font font1">Agrega tus Direcciones</h2>

            </header>



        </div>

        <div class="container">



            <div class="pull-left">

                <a href="{{ url('/user/direccion/create') }}" class="btn btn-primary">

                    Nueva Dirección

                </a>

            </div>



            <hr/>





            @include('feedback')





            <div class="">

                <table class="table table-hover text-center color-black">

                    <thead>

                    <tr>

                        <td>Nombre</td>

                        <td>País</td>

                        <td>Estado, Municipio</td>

                        <td>Calle, Número</td>

                        <td>C.P</td>

                        <td>Predeterminada</td>
                        <td></td>

                    </tr>

                    </thead>

                    <tbody>




                        @foreach ($direccions as $direccion)

                            <tr>

                                <td>{{ $direccion->name }}</td>

                                <td>{{ $direccion->pais }}</td>

                                <td>{{ $direccion->calle . ', ' . 'Ext: ' . $direccion->num_ext . ', Int: ' . $direccion->num_int }}</td>

                                <td>{{ $direccion->estado . ', ' . $direccion->municipio }}</td>

                                <td>{{ $direccion->codigop }}</td>

                                <td>

                                    <form action="{{ url('/user/direccion/set_default') }}" method="POST" id="form-default-direction">

                                        {{ csrf_field() }}

                                    <input type="radio" class="default" name="default"

                                           {{$direccion->default ? 'checked' : ''}} value="{{ $direccion->id }}"/>
                                    </form>


                                </td>
                                <td>
                                    
                                    <form id="eliminar {{ $direccion->id }}" method="POST" action="{{ route('direccion_delete') }}">
                                        {{ csrf_field() }}

                                        <input type="hidden" name="direccion" value="{{$direccion->id}}">
                                        <button class="btn btn-link" onclick="if(confirm('¿Deseas eliminar esta dirección?')){
                                            this.form.submit();
                                        }"><i class="fas fa-times"></i> Eliminar</button>
                                    </form>
                                </td>

                            </tr>

                        @endforeach

                    



                    </tbody>

                </table>

            </div>

        </div>



    </section>



@endsection





@section('scripts')

    <script>

        $(function () {

            $('.default').on('change', function () {

                $("#form-default-direction").submit();// submitting the form when user press yes

            });

        });

    </script>
   {{--  <script>
        function deleteFunction(etiqueta){
            event.preventDefault(); // prevent form submit
            if(confirm("¿Deseas eliminar esta dirección?")){
                document.getElementById(etiqueta).submit();          // submitting the form when user press yes
            }
        }
    </script> --}}

@endsection





