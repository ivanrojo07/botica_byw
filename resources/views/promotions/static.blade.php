@extends('layouts.app')
@section('content')
    <section id="four" class="wrapper style1 special fade-up">
        <div id="productos" class="container">
            @if($category_selected)
                <header class="major">
                    <h2 class="grey satisfic-font font1">
                        Productos en Promoción
                    </h2>
                </header>
            @endif
            <br/>
            <form action="{{url('promotions') }}" method="GET">
                <div class="row uniform">
                    <div class="col-lg-3">
                        <h1 class="grey">
                            Nombre Producto
                        </h1>
                        <input type="text" name="title" id="title" class="form-control" value="{{ $title }}"
                               style="height: 36px !important;"/>
                    </div>
                    <div class="col-lg-3">
                        <h1 class="grey">
                            Precio Máximo
                        </h1>
                        <input type="number" name="max_price" id="max_price" class="form-control"
                               value="{{ $max_price }}"/>
                    </div>
                    <div class="col-lg-3">
                        <h1 class="grey">
                            Fecha de Creación
                        </h1>
                        <select name="order_created_at" id="order_created_at" class="form-control">
                            <option value="">Selecciona una opción</option>
                            <option value="asc" {{ ($order_created_at == 'asc') ? 'selected' : '' }}>
                                Ascendente
                            </option>
                            <option value="desc" {{ ($order_created_at == 'desc') ? 'selected' : '' }}>
                                Descendente
                            </option>
                        </select>
                    </div>
                </div>
                <br/>
                <button type="submit" class="btn btn-primary">
                    Filtrar
                </button>
                <a href="{{ url('promotions') }}" class="btn btn-info">
                    Limpiar Filtros
                </a>
            </form>
            @include('feedback')
            <hr>
            @if(Session::has('favorite_status'))
                <div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>
                        {{ Session::get('favorite_status') }}
                        <a href="{{ url('user/my-favorite-products') }}">, Ir a mis Favoritos</a>
                    </strong>
                </div>
                <br/>
            @endif
 <div class="container">
        <table class="table table-hover text-center color-black">
            <thead>
                <tr>
                    <td>Nombre</td>
                    <td>Categoría</td>
                    <td>Descripción</td>
                    <td>Precio</td>
                    <td>Precio de Promoción</td>
                    <td>Código de Proveedor</td>
                    <td>Cantidad Vendida</td>
                    <td>Total de Producto</td>
                </tr>
            </thead>
            <tbody>
                 @foreach ($products as $product)
                <tr>
                     <td>{{$product->title}}</td>
                     <td>{{$product->category}}</td>
                     <td>{{$product->description}}</td>
                     <td>${{$product->pricing}}</td>
                     <td>${{$product->promotion_pricing}}</td>
                     <td>{{$product->codigo_proveedor}}</td>
                      @foreach ($inter as $int)
                       @if($product->id==$int[0])
                     <td>{{$int[1]}}</td>
                     <td>${{$int[1]*$product->promotion_pricing}}</td>
                       @endif
                      @endforeach
                 </tr>
                 @endforeach
            </tbody>
        </table>    
 </div>                  
                    @if(!count($products))
                        <div class="col-lg-12 alert alert-warning">
                            <strong>No hay productos disponibles.</strong>
                        </div>
                    @endif
                    <div class="pagination">
                    {{ $products->links('vendor.pagination.bootstrap-4') }}
                    </div>
    </section>
@endsection