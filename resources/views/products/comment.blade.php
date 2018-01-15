@extends('layouts.app')
@section('content')

    <header class="major">
        <h2 class="grey satisfic-font  font12">
            Agrega un comentario para el producto:
            <br/>
            {{ $product->title }}
        </h2>
    </header>
    <div class="container">
        <div class="col-md-8 margin-large margin-bottom-cort">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method='post' action='{{url("user/product/comment")}}' enctype='multipart/form-data'>
                {{csrf_field()}}
                <input type="hidden" name="id" value="{{ $product->id }}"/>
                <input type="hidden" name="back_url" value="{{ url()->previous() }}"/>
                <div class="form-group">
                    <label for="comment">Describe tu comentario sobre el producto:</label>
                    <textarea type="text" name="comment" id="comment" class="form-control"></textarea>
                </div>

                <div class="form-group">
                    <a href="{{url()->previous() }}" class="btn btn-primary">Regresar</a>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>

            </form>
        </div>


    </div>


@stop
