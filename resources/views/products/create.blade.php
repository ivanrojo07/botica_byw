@extends('layouts.app')
@section('content')
<div class="container white margin-top">
	<h1 class="color-grey font-ch">Nuevo Producto</h1>
	@include('products.form', ['product' => $product, 'url' => '/products', 'method' => 'POST'])
</div>
@endsection