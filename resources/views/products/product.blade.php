<section class="products1 4u 6u$(medium) 12u$(xsmall) curacion">

    <header class="text-center">



        <div class="pull-left">



            @if(Auth::check())

                @if($favoriteProduct->isFavorite($product->id))

                    <a href="{{ url('/user/product/' . $product->id . '/favorite/remove') }}"

                       title="remover de favoritos">

                        <i class="fa fa-star"></i>



                    </a>

                @else

                    <a href="{{ url('/user/product/' . $product->id . '/favorite/add') }}" title="agregar a favoritos">

                        <i class="fa fa-star-o"></i>

                    </a>

                @endif



                <a href="{{ url('/user/product/' . $product->id . '/comment') }}" title="Valorar producto">

                    <i class="fa fa-comment"></i>

                </a>



            @endif



        </div>

        <br>

        <h1 class="grey">{{$product->title}}</h1>

    </header>



    @if($product->extension)

        <img class="bt1" src="{{ url("/img_prod/$product->id.$product->extension")}}" class="product_avatar">

    @else

        <img class="bt1" src="{{ asset('img/12.jpg') }}" class="product_avatar">

    @endif



    <br>



    <h5 class="grey">

        <strong>Categoria:</strong>



        {{$product->cat->title}}

    </h5>



    <p class="grey">



    </p>



    <h5 class="grey">

        <strong>descripcion</strong>

    </h5>



    <p class="grey">

        {{$product->description}}

    </p>



    <strong>

        <p class="costo orangep">

            @if(isset($promotion) && $promotion)

                $ {{$product->promotion_pricing}} usd

            @else

                $ {{$product->pricing}} usd

            @endif

        </p>

    </strong>



    @include("in_shopping_carts.form",["product" => $product])



    <br/>



</section>

 