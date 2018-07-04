@extends('layouts.app')
@section('content')
<div class="container white margin-top " style="margin-top: 100px !important;">
	{{-- {{ $product}} --}}
	@include('products.form', ['product' => $product, 'url' => '/products/'.$product->id, 'method' => 'PATCH'])
</div>
<br>
@endsection