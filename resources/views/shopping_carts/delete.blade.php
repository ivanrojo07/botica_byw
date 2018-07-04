{!!Form::open(array('url' => '/shopping_carts/'.$product->id, 'method' => 'DELETE','class' => 'inline-block'))!!}
    <input type="submit" class="btn btn-link red no-padding no-margin no-transform np" value="Eliminar">
{!! Form::close() !!}