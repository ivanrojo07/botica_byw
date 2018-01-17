@extends('layouts.app')

@section('content')
{{-- {{dd($sales->)}} --}}
    <section id="four" class="wrapper style1 special fade-up">

        <div class="container">

            <header class="major">

                <h2 class="grey satisfic-font font1">

                    Ventas

                </h2>

                <p class="pprofile">

                    Viazualiza los productos vendidos, TOTAL DE ({{ $count_products }}) PRODUCTOS Vendidos

                </p>

            </header>





            <br/>



            <form action="{{url('admin/sales') }}" method="GET">

                <div class="row uniform">

                    <div class="col-lg-4">

                        <h1 class="grey">Usuario</h1>

                        <select name="user" id="user" class="form-control">

                            <option value="all" selected>Todos</option>

                            <option value="0"

                                    {{ ($user_selected && $user_selected ==  0) ? 'selected' : ''}}>

                                Invitado

                            </option>

                            @foreach($users as $user)

                                <option value="{{ $user->id }}"

                                        {{ ($user_selected && $user_selected ==  $user->id) ? 'selected' : ''}}>

                                    {{ $user->email }}

                                </option>

                            @endforeach

                        </select>

                    </div>



                    <div class="col-lg-4">

                        <h1 class="grey">

                            Nombre Producto

                        </h1>

                        <input type="text" name="title" id="title" class="form-control" value="{{ $title }}"

                               style="height: 36px !important;"/>

                    </div>



                    <div class="col-lg-4">

                        <h1 class="grey">

                            Cantidad

                        </h1>

                        <input type="number" name="qty" id="qty" class="form-control"

                               value="{{ $qty }}"/>

                    </div>



                </div>



                <br/>



                <button type="submit" class="btn btn-primary">

                    Filtrar

                </button>



                <a href="{{ url('admin/sales?user=all') }}" class="btn btn-info">

                    Limpiar Filtros

                </a>



            </form>



        </div>



        <div class="container">

            <div class="row">

                <div class="col-lg-12">

                    @if(count($sales))

                        <table class="table table-hover table-striped">

                            <thead>

                            <tr>

                                <td># Carrito</td>

                                <td>Usuario</td>

                                <td>Nombre Producto</td>

                                <td>Cantidad</td>

                                <td>Código Proveedor</td>

                            </tr>

                            </thead>

                            <tbody>

                            @foreach($sales as $sale)

                                <tr>

                                    <td>

                                        {{ $sale->shoppingcart->id }}

                                    </td>

                                    <td>

                                        {{ ($sale->shoppingcart->user_id != null )

                                            ? '#'.$sale->shoppingcart->user->id . ' ' . $sale->shoppingcart->user->email

                                            : 'Invitado'

                                        }}

                                    </td>

                                    <td>
                                        @if (count($sale->product) == 0)
                                            {{-- true expr --}}
                                            no existe el producto
                                        @else
                                            {{ $sale->product->title }}
                                            {{-- false expr --}}
                                        @endif

                                    </td>

                                    <td>

                                        {{ $sale->qty }}

                                    </td>

                                    <td>
                                        @if (count($sale->product) == 0)
                                            {{-- true expr --}}
                                            no existe el producto
                                        @else
                                            {{ $sale->product->codigo_proveedor }}
                                            {{-- false expr --}}
                                        @endif

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

                {{ $sales->links() }}

            </div>



        </div>



    </section>

@endsection