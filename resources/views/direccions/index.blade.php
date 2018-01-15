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
                    </tr>
                    </thead>
                    <tbody>

                    <form action="{{ url('/user/direccion/set_default') }}" method="POST" id="form-default-direction">
                        {{ csrf_field() }}
                        @foreach ($direccions as $direccion)
                            <tr>
                                <td>{{ $direccion->name }}</td>
                                <td>{{ $direccion->pais }}</td>
                                <td>{{ $direccion->calle . ', ' . 'Ext: ' . $direccion->num_ext . ', Int: ' . $direccion->num_int }}</td>
                                <td>{{ $direccion->estado . ', ' . $direccion->municipio }}</td>
                                <td>{{ $direccion->codigop }}</td>
                                <td>
                                    <input type="radio" class="default" name="default"
                                           {{$direccion->default ? 'checked' : ''}} value="{{ $direccion->id }}"/>
                                </td>
                            </tr>
                        @endforeach
                    </form>

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
                $("#form-default-direction").submit();
            });
        });
    </script>
@endsection


