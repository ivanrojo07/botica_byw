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
                <div class="row uniform">
                    <div class="col-lg-offset-3 col-lg-6">
                        <h1 class="grey">
                        Nombre del Producto
                        </h1>
                        <input type="text" name="title" id="title" class="form-control" value="{{ $title }}"
                               style="height: 36px !important;"/>
                    </div>
                     
                     </div>
                <br/>
                <button type="submit" class="btn btn-primary">
                    Filtrar
                </button>
                <a href="{{ url('/promovisita') }}" class="btn btn-info">
                    Limpiar Filtros
                </a>
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
                    {{ $products->links() }}
                </div>
    </section>
@endsection