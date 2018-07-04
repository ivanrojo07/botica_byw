@extends('layouts.app')

@section('content')
    <section id="four" class="wrapper style1 special fade-up">
        <div id="productos" class="container">
            <header class="major">
                <h2 class="grey satisfic-font font1">
                    Mis Productos Favoritos
                </h2>
            </header>
            <br/>
            @if(Session::has('favorite_status'))
                <div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>
                        {{ Session::get('favorite_status') }}
                    </strong>
                </div>
                <br/>
            @endif
            <div class="box alt ">
                <div class="row uniform">
                    @foreach ($products as $product)
                        @include("products.product", ["product" => $product, 'promotion' => (is_object($product->cat) && $product->cat->slug == 'Promociones') ? 1 : 0])
                    @endforeach
                    @if(!count($products))
                        <div class="col-lg-12 alert alert-warning">
                            <strong>No has agregado Favoritos.</strong>
                        </div>
                    @endif
                </div>
                <div class="pagination">
                    {{ $products->links() }}
                </div>
            </div>
    </section>
@endsection