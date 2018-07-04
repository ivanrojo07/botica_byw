{!! Form::open(['url' => $url, 'method' => $method, 'files' => true]) !!}
<div class="container">
    <header class="major">
        <h2 class="grey satisfic-font font1">Editando producto</h2>
    </header>
    <div class="form-group col-sm-5 col-md-5">
        <label for="title">Titulo:</label>
        {{ Form::text('title', $product->descripcion, ['class' => 'form-control', 'placeholder'=>'Titulo....']) }}
    </div>
{{-- 
    <div class="form-group">
        <select name="category_id" id="category_id" class="form-control">
            <option value="">Selecciona una opción</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ ($product->category_id == $category->id) ? 'selected' : '' }}>
                    {{ $category->description }}
                </option>
            @endforeach
        </select>
        {{-- Form::text('category', $product->category, ['class' => 'form-control', 'placeholder'=>'Categoria del producto....']) --}}
   {{--  </div>
 --}} 
    <div class="form-group col-sm-5 col-md-5">
        <label for="pricing">Precio al publico (sin contar impuestos y ganancias):</label>
        <div class="input-group">
            <span class="input-group-addon">$</span>
        {{ Form::number('pricing',$product->precio_publico, ['step'=>'0.01', 'class' => 'form-control', 'placeholder'=>'Precio de tu producto....(en MXN)']) }}
            <span class="input-group-addon">MXN</span>
        </div>
    </div>
    <div class="form-group col-sm-10 col-md-10">
        {{ Form::file('cover') }}
    </div>
    <div class="form-group col-sm-12 col-md-12">
        <label for="description">Descripcion terapeutica:</label>
        {{ Form::textarea('description', $product->descripcion_terapeutica, ['class' => 'form-control', 'placeholder'=>'Describe tu producto....']) }}
    </div>
    <div class="form-group text-right col-sm-12 col-md-12">
        <input type="submit" value="Enviar" class="btn btn-success">
        <button onclick="window.location.href='{{url('/products')}}'" type="button" class="btn btn-primary">Regresar
        </button>
   </div>
</div>
{!! Form::close() !!}