@extends('layouts.app')

@section('content')

    <section id="four" class="wrapper style1 special fade-up" @if (count($recetas) ==0)
        {{-- expr --}}
        style="height: 595px !important;" 
    @endif>

        <div class="container">

            <header class="major">

                <h2 class="grey satisfic-font font1">

                    Recetas Generadas

                </h2>

                <p class="pprofile">

                    Viazualiza Todas las Recetas de los Pedidos

                </p>

            </header>



        </div>



        <div class="container">

            <div class="row">

                <div class="col-lg-12">

                    @if(count($recetas))

                        <table class="table table-hover table-striped">

                            <thead>

                            <tr>

                                <td># Venta</td>

                                <td>Usuario</td>

                                <td>Receta</td>

                            </tr>

                            </thead>

                            <tbody>

                            @foreach($recetas as $receta)

                                <tr>

                                    <td>

                                        {{ $receta->id }}

                                    </td>

                                    <td>

                                        {{ ($receta->shoppingcart->user_id != null )

                                            ? '#'.$receta->shoppingcart->user->id . ' ' . $receta->shoppingcart->user->email

                                            : 'Invitado'

                                        }}

                                    </td>

                                    <td>

                                        <form action=" {{ url('/user/order/get-receta') }}" method="POST">

                                            {{ csrf_field() }}

                                            <input type="hidden" name="url_receta_path"

                                                   value="{{ $receta->shoppingcart->receta_path }}"/>

                                            <button class="btn btn-success">Descargar Receta</button>

                                        </form>

                                    </td>

                                </tr>

                            @endforeach

                            </tbody>

                        </table>

                    @else

                        <div class="alert alert-warning">

                            No hay productos vendidos

                        </div>

                    @endif

                </div>

            </div>



            <div class="pagination">

                {{ $recetas->links() }}

            </div>



        </div>



    </section>

@endsection