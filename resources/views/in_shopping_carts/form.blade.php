{!! Form::open(['url' => '/in_shopping_carts', 'method' => 'POST',"class" => "inline-block" ]) !!}

<input type="hidden" name="product_id" value="{{$product->id}}">
<div class="form-group">
    <div class="col-lg-4">
        <input type="number" name="qty" value="1" class="form-control" placeholder="cantidad"/>
    </div>
    <div class="col-lg-6">
        <input type="submit" value="Agregar al carrito" class="btn btn-primary ">
    </div>
</div>
{!! Form::close() !!}




{!! Form::open(['url' => '/in_shopping_carts', 'method' => 'POST',"class" => " " ]) !!}
        <input type="hidden" name="promotion_id" value="{{$product->id}}">
        <input type="hidden" name="qty" value="1" > 
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">Cant.</span>
            </div>
            <input type="number" name="qty" class="form-control" value="1">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">
                    <i class="price-text-color fa fa-shopping-cart"></i>
                </button>                                                          
            </div>
        </div>
        {!! Form::close() !!}