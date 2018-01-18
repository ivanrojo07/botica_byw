{!! Form::open(['url' => $url, 'method' => $method, 'files' => true]) !!}

<div class="container">

    <div class="form-group">

        {{ Form::text('title', $product->title, ['class' => 'form-control', 'placeholder'=>'Titulo....']) }}

    </div>

    <div class="form-group">

        <select name="category_id" id="category_id" class="form-control">

            <option value="">Selecciona una opción</option>

            @foreach($categories as $category)

                <option value="{{ $category->id }}" {{ ($product->category_id == $category->id) ? 'selected' : '' }}>

                    {{ $category->title }}

                </option>

            @endforeach

        </select>

        {{-- Form::text('category', $product->category, ['class' => 'form-control', 'placeholder'=>'Categoria del producto....']) --}}

    </div>

    <div class="form-group">

        {{ Form::number('pricing', (is_object($product->cat) && $product->cat->title == 'Promociones') ? $product->promotion_pricing : $product->pricing, ['step'=>'0.01', 'class' => 'form-control', 'placeholder'=>'Precio de tu producto....']) }}

    </div>

    <div class="form-group">

        {{ Form::file('cover') }}

    </div>

    <div class="form-group">

        {{ Form::textarea('description', $product->description, ['class' => 'form-control', 'placeholder'=>'Describe tu producto....']) }}

    </div>

    <div class="form-group text-right">

        <input type="submit" value="Enviar" class="btn btn-success">

        <button onclick="window.location.href='{{url('/products')}}'" type="button" class="btn btn-primary">Regresar

        </button>



    </div>

</div>

{!! Form::close() !!}