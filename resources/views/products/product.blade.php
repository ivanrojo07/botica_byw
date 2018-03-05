

  <div class="col-sm-6 col-md-4">
    <div class="thumbnail">
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

        <h1 class="grey"><a href="{{ url('/products/'.$product->id) }}">{{$product["descripcion"]}}</a></h1>

    </header>
    @if($product->extension)

        <img class="bt1" src="{{ url("/img_prod/$product->id.$product->extension")}}" class="product_avatar">

    @else

        <img class="bt1"  alt="100%x200" src="{{ asset('img/12.jpg') }}" class="product_avatar">

    @endif
        {{-- <img alt="100%x200" data-src="holder.js/100%x200" style="height: 200px; width: 100%; display: block;" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iMjQyIiBoZWlnaHQ9IjIwMCIgdmlld0JveD0iMCAwIDI0MiAyMDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjwhLS0KU291cmNlIFVSTDogaG9sZGVyLmpzLzEwMCV4MjAwCkNyZWF0ZWQgd2l0aCBIb2xkZXIuanMgMi42LjAuCkxlYXJuIG1vcmUgYXQgaHR0cDovL2hvbGRlcmpzLmNvbQooYykgMjAxMi0yMDE1IEl2YW4gTWFsb3BpbnNreSAtIGh0dHA6Ly9pbXNreS5jbwotLT48ZGVmcz48c3R5bGUgdHlwZT0idGV4dC9jc3MiPjwhW0NEQVRBWyNob2xkZXJfMTYxYmYyZTUyYWMgdGV4dCB7IGZpbGw6I0FBQUFBQTtmb250LXdlaWdodDpib2xkO2ZvbnQtZmFtaWx5OkFyaWFsLCBIZWx2ZXRpY2EsIE9wZW4gU2Fucywgc2Fucy1zZXJpZiwgbW9ub3NwYWNlO2ZvbnQtc2l6ZToxMnB0IH0gXV0+PC9zdHlsZT48L2RlZnM+PGcgaWQ9ImhvbGRlcl8xNjFiZjJlNTJhYyI+PHJlY3Qgd2lkdGg9IjI0MiIgaGVpZ2h0PSIyMDAiIGZpbGw9IiNFRUVFRUUiLz48Zz48dGV4dCB4PSI4OS44MDQ2ODc1IiB5PSIxMDUuMSI+MjQyeDIwMDwvdGV4dD48L2c+PC9nPjwvc3ZnPg==" data-holder-rendered="true"> --}}
      
    <div class="caption">
        <h5 class="grey">

            <strong>Categoria:</strong>

        </h5>





    <p class="grey">

        @if (isset($product->tipo_de_producto))
            {{-- true expr --}}
            {{$product->tipo_de_producto}}
        @else
            Sin categoría
            {{-- false expr --}}
        @endif


    </p>
    @if (isset($product["sustancia_activa"]) && $product["sustancia_activa"] != "")
        {{-- expr --}}
        <h5 class="grey">

            <strong>Sustancia Activa:</strong>
            <p class="grey">{{$product["sustancia_activa"]}}</p>
        </h5>
    @endif



    <h5 class="grey">

        <strong>descripcion</strong>

    </h5>



    <p class="grey">

        {{$product["descripcion_terapeutica"]}}

    </p>



    <strong>

        <p class="costo orangep">

            @if(isset($promotion) && $promotion)

                $ {{$product->promotion_pricing}} usd

            @else

                $  {{number_format(($product["precio_publico"]+($product["precio_publico"]*($product["iva"]/100))+($product["precio_publico"]*($product["ieps"]/100))+($product["precio_publico"]*($product["impuesto_3"]/100))),2)}}  MXN

            @endif

        </p>

    </strong>



    @include("in_shopping_carts.form",["product" => $product])
      </div>
    </div>
  </div>

{{-- <section class="products1 4u 6u$(medium) 12u$(xsmall) curacion">

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
    <br/>
    <br/>


</section>


  --}}
