@extends('layouts.app')
@section('content')
    <div class="container">
    <h1 class="mt-4">Productos</h1>
        <table class="table table-hover text-center color-black">
            <thead>
            <tr>
                <td>Id</td>
                <td>Titulo</td>
                <td>Categoria</td>
                <td>Descripcion</td>
                <td>Precio</td>
                <td>Acciones</td>
            </tr>
            </thead>
            <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->descripcion }}</td>
                    <td>{{ (is_object($product->tipo_de_producto)) ? $product->tipo_de_producto : 'N/A' }}</td>
                    <td>{{ $product->descripcion_terapeutica }}</td>
                    <td>$ {{ (is_object($product->cat) && $product->cat->title == 'Promociones') ? $product->promotion_pricing :number_format((($product["precio_publico"]+($product["precio_publico"]*($product["iva"]/100))+($product["precio_publico"]*($product["ieps"]/100))+($product["precio_publico"]*($product["impuesto_3"]/100))+($product['precio_publico']*(0.40)))/$cambio[0]),2) }} USD</td>
                    <td>
                    <a class="green" href="{{url("/products/$product->id")}}">Ver</a>
                        @if(Auth::check() && Auth::user()->rol == 'admin')                            
                            <a href="{{url('/products/'.$product->id.'/edit')}}">Editar</a>
                            @include('products.delete',['product' => $product])
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination">
                    {{ $products->links() }}
                </div>
    </div>
   {{--  <div class="floating">
        <a href="{{url('/products/create')}}" class="btn btn-default btn-fab">
            <i class="material-icons">add</i>
        </a>
    </div> --}}
@endsection

