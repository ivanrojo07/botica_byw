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
            <form action="{{url('/promovisita') }}" method="GET">
                <h1 class="grey">
                    Nombre del Producto
                </h1>
                <div class="input-group">
                    <input type="text" name="title" id="title" class="form-control" value="{{ $title }}" placeholder="producto" aria-label="producto" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-success" type="button">Filtrar</button>
                        <a href="{{ url('/promovisita') }}" class="btn btn-secondary">
                            Limpiar Filtros
                        </a>
                    </div>
                </div>
            </form>
            @include('feedback')
            <hr/>
 <div class="container">
     <div class="box alt">
         <div class="row uniform">
             @foreach ($products as $product)
                 {{-- expr --}}
                 @include("promotions.product",["product"=>$product])
             @endforeach
         </div>
     </div>
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