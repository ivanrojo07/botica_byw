@extends('layouts.app')
@section('content')
    <section id="four" class="wrapper style1 special fade-up">
        <div class="container">
            <header class="major">
                <h2 class="grey satisfic-font font1">
                    Mis Ordenes
                </h2>
                <p class="pprofile">
                    Visualiza el detalle de cada uno de tus pedidos.
                </p>
            </header>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    @if(count($orders))
                        <table class="table table-hover table-striped">
                            <thead>
                            <tr>
                                <td>#</td>
                                <td>Estatus</td>
                                <td>Total</td>
                                <td>Receta</td>
                                <td>Fecha Creación</td>
                                <td>Detalle</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>
                                        {{ $order->customid }}
                                    </td>
                                    <td>
                                        @if ($order->status == "approve")
                                            {{-- expr --}}
                                            Aprobada
                                        @endif
                                      {{-- {{ $order->status }} --}}
                                    </td>
                                    <td>
                                        $ {{ number_format($order->total, '2') }} USD
                                    </td>
                                    <td>
                                        <form action="{{ url('/user/order/get-receta') }}" method="POST">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="url_receta_path"
                                                   value="{{ $order->receta_path }}"/>
                                            <button  class="btn btn-success" type="submit">
                                                Descargar Receta
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        {{ $order->created_at }}
                                    </td>
                                    <td>
                                        <a href="{{ url('/pedido/' . $order->customid)  }}">Ver Tracking</a>
                                        <br>
                                        <a href="{{ url('/compras/' . $order->customid)  }}">Ver Pedido</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-warning">
                            No tienes pedidos
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <hr>
@endsection