@extends('layouts.app')
@section('content')
    <div class="container" style="margin-top: 105px; margin-bottom: 100px;">
        <div class="col-md-offset-4 col-md-9 col-sm-offset-4 col-sm-9">
            @include("promotions.product",["product"=>$product])
        </div>
    </div>
@endsection