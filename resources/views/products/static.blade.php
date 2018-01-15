@extends('layouts.app')
@section('content')
    <section id="four" class="wrapper style1 special fade-up">
        <div id="productos" class="container">


            @if($category_selected)
                <header class="major">
                    <h2 class="grey satisfic-font font1">
                        {{ $category_selected->title }}
                    </h2>
                </header>
            @endif

            <br/>

            <form action="{{url('Products1') }}" method="GET">
                <div class="row uniform">
                    <div class="col-lg-3">
                        <h1 class="grey">Categoría</h1>
                        <select name="category" id="category" class="form-control">
                            <option value="all" selected>Todas</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->slug }}"
                                        {{ ($category_selected && $category_selected->slug ==  $category->slug) ? 'selected' : ''}}>
                                    {{ $category->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>

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

                <a href="{{ url('Products1?category=all') }}" class="btn btn-info">
                    Limpiar Filtros
                </a>

            </form>

            @include('feedback')

            <hr/>

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


            <div class="box alt ">
                <div class="row uniform">

                    @foreach ($products as $product)
                        @include("products.product", ["product" => $product])
                    @endforeach

                    @if(!count($products))
                        <div class="col-lg-12 alert alert-warning">
                            <strong>No hay productos disponibles.</strong>
                        </div>
                    @endif


                </div>

                <div class="pagination">
                    {{ $products->links() }}
                </div>

               <footer class="major">
                    <ul class="actions">
                        <li><a href="{{ url('/products') }}" class="button blue-template1">Ver todos los Productos</a>
                        </li>
                    </ul>
                </footer>

            </div>
    </section>

@endsection