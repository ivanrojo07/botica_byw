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



                    <div class="col-lg-3">

                        <h1 class="grey">

                            Nombre del Producto

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



                   <!--  <div class="col-lg-3">

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

                    </div> -->

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

      <div id="carousel-example" class="carousel slide hidden-xs" data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item active">
                    <div class="row">
                        @foreach ($products as $product)
                            {{-- expr --}}
                        <div class="col-sm-3">
                            <div class="col-item">
                                <div class="photo">
                                    <img src=
                                    @if ($product->extension)
                                        {{-- true expr --}}
                                        "{{ url("/img_prod/$product->id.$product->extension")}}"
                                    @else
                                        {{-- false expr --}}
                                        "{{ asset('img/12.jpg') }}"
                                    @endif class="img-responsive" alt="a" />
                                </div>
                                <div class="info">
                                    <div class="row">
                                        <div class="price ">
                                            <h5 class="price-text-color">
                                                {{$product->title}}</h5>
                                            <h5 class="price-text-color">
                                                @if(isset($promotion) && $promotion)

                                                    $ {{$product->promotion_pricing}} usd

                                                @else

                                                    $ {{$product->promotion_pricing}} usd

                                                @endif</h5>
                                        </div>
                                        
                                    </div>
                                    <div class="clearfix">
                                            {!! Form::open(['url' => '/in_shopping_carts', 'method' => 'POST' ]) !!}
                                            <input type="hidden" name="product_id" value="{{$product->id}}">
                                            <input type="hidden" name="qty" value="1" >

                                        <p class="btn">
                                                     <i class="price-text-color fa fa-shopping-cart"></i><button type="submit" class="btn btn-link hidden-sm">Agregar al carrito</button>
                                        </p>



                                            {!! Form::close() !!}
                                           
                                    </div>
                                    <div class="clearfix">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="item">
                    @foreach ($products as $product)
                            {{-- expr --}}
                        <div class="col-sm-3">
                            <div class="col-item">
                                <div class="photo">
                                    <img src=@if ($product->extension)
                                        {{-- true expr --}}
                                        "{{ url("/img_prod/$product->id.$product->extension")}}"
                                    @else
                                        {{-- false expr --}}
                                        "{{ asset('img/12.jpg') }}"
                                    @endif class="img-responsive" alt="a" width="350px" height="260px" />
                                </div>
                                <div class="info">
                                    <div class="row">
                                        <div class="price">
                                            <h5 class="price-text-color">
                                                {{$product->title}}</h5>
                                            <h5 class="price-text-color">
                                                @if(isset($promotion) && $promotion)

                                                    $ {{$product->promotion_pricing}} usd

                                                @else

                                                    $ {{$product->promotion_pricing}} usd

                                                @endif</h5>
                                        </div>
                                    </div>
                                    <div class="clearfix">
                                            {!! Form::open(['url' => '/in_shopping_carts', 'method' => 'POST' ]) !!}
                                            <input type="hidden" name="product_id" value="{{$product->id}}">
                                            <input type="hidden" name="qty" value="1" >

                                        <p class="btn">
                                                     <i class="price-text-color fa fa-shopping-cart"></i><button type="submit" class="btn btn-link hidden-sm">Agregar al carrito</button>
                                        </p>



                                            {!! Form::close() !!}
                                           
                                    </div>
                                    <div class="clearfix">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                </div>
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



                <!--<footer class="major">

                    <ul class="actions">

                        <li><a href="{{ url('/products') }}" class="button blue-template1">Ver todos los Productos</a>

                        </li>

                    </ul>

                </footer>-->



           






    </section>



@endsection