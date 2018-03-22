@extends("layouts.app")

@section("content")

<header class="big-padding  satisfic-font">

  <h1 class="grey text-center">¡Tu compra ha sido completada!</h1>

</header>

<div class="container">

  <div class="card large-padding">

    {{-- <h3 class="text-center grey">Tu pago fue  <span class="{{ $order->status }}">{{ $order->status}}</span></h3> --}}

    <p>Corrobora  los detalles de tu envio:</p>

    <div class="row">

      <div class="col-xs-6">Nombre</div>

      <div class="col-xs-6">{{ $shopping_cart->direccion->name }}</div>

    </div>
    <div class="row">

      <div class="col-xs-6">Correo</div>

      <div class="col-xs-6">{{ $shopping_cart->direccion->email }}</div>

    </div>

    <div class="row">

      <div class="col-xs-6">Direccion</div>

      <div class="col-xs-6">Calle: {{ $shopping_cart->direccion->calle }}, #{{$shopping_cart->direccion->num_ext}}, @if ($shopping_cart->direccion->num_int != null)
        {{-- expr --}}
        interior {{$shopping_cart->direccion->num_int}}
      @endif , Municipio {{$shopping_cart->direccion->municipio}}
      </div>

    </div>

     <div class="row">

      <div class="col-xs-6">Codigo Postal</div>

      <div class="col-xs-6">@if ($shopping_cart->direccion->codigop == null)
        {{-- true expr --}}
        Sin código postal
      @else
        {{-- false expr --}}
        {{$shopping_cart->direccion->codigop}}
      @endif</div>

    </div>

     <div class="row">

      <div class="col-xs-6">Ciudad</div>

      <div class="col-xs-6">{{ $shopping_cart->direccion->ciudad }}</div>

    </div>

     <div class="row">

      <div class="col-xs-6">Estado y País</div>

      <div class="col-xs-6">{{ $shopping_cart->direccion->estado }} {{ $shopping_cart->direccion->pais }}</div>

    </div>

    <div class="row">

      <div class="col-xs-6">El total de tu compra es:</div>

      <div class="col-xs-6">${{ $order->total }} USD</div>

    </div>

    <p class="text-center"><strong>El tiempo estimado de la entrega es de 5 a 7 dias habiles</strong></p>

   <!-- <div class="text-center">

      <a href="{{ url('/compras', $shopping_cart->customid)}}">Link permanente de tu compra</a>

    </div><-->

      <button onclick="window.location.href='{{url('/user/my-orders')}}'" type="button" class="btn btn-primary center-block">Regresar</button>



      <br>

  </div>

</div>



@endsection