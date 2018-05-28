{!! Form::open(['url' => '/in_shopping_carts', 'method' => 'POST',"class" => "inline-block" ]) !!}
<input type="hidden" name="promotion_id" value="{{$product->id}}">
<div class="form-group">
    <div class="col-lg-4">
        <input type="number" name="qty" value="1" class="form-control" placeholder="cantidad"/>
    </div>
    <div class="col-lg-6">
        <input type="submit" value="Agregar al carrito" class="btn btn-primary ">
    </div>
</div>
{!! Form::close() !!}