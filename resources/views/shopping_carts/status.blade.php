@extends('layouts.app')
@section('content')
	{{-- expr --}}
	<section id="four" class="wrapper style1 special fade-up">

					<div class="container">

						

			<div id="productos" class="container">

		<header class="major">
			<img src="{{ asset('/img/sky.png') }}">
			<br>
			<br>
      <br>

			<h2 class="grey satisfic-font font1">Pedido # {{$shopping_cart->customid}}</h2>

		</header>

	</div>				

			

			<div class="10u$ 12u$(medium) important(medium) faq">

	<section id="content">
<div class="row jumbotron">
    <div class="title">
      <h4 class="col-xs-12" style="color: black;">
        <strong>Rastrear pedido no. {{$shopping_cart->customid}}</strong>
        <p class="pipe">Comprado el: {{$shopping_cart->created_at->format('d/m/Y')}} <span class="pipe">Total: ${{ $shopping_cart->total }} USD</span></p>
      </h4>
    </div>

          <div class="item-row">
        <div class="col-lg-7 col-md-6">
			<div class="product col-xs-12">
              <div class="image-container col-lg-3 col-md-4 col-xs-2">
                <img src="{{ asset('/img/12.jpg') }}" height="100" width="auto">
              </div>
              <div class="detail-container col-lg-9 col-md-8 col-xs-10">

                <p class="col-lg-5 col-md-7">Número de Bultos: {{ $tracking->bultos}}</p>
                <p class="col-lg-5 col-md-7">Peso: {{ $tracking->peso}} Kg.</p>
              </div>
            </div>
        </div>
        <div class="tracking col-lg-5 col-md-6 col-xs-12">
                      <p class="row">Paquetería: Sky Conexión</p>
            <p class="row tracking-number">Número de guía (HAWB):{{$tracking->hawb}}</p>
              	<ul id="tracking-events" class="tracking-events-container in">
              	@foreach ($tracking->hito as $hito)
              		{{-- expr --}}
              		<li>
                    	<span>{{$hito->fecha}} | {{$hito->hora}}</span>
                    	<span>{{$hito->status}}</span>
              		</li>
              	@endforeach
                    
				</ul>
                           
        </div>
      </div>
      </div>

<br><br><br><br>
    {{-- <div class="jumbotron">
      <div class="panel panel-default" >
        <div class="panel-heading" style="background: #F5F5F5;">Pedido No. 234131562 <br>Comprado el 03/01/18 Total: $93.90 <button class="btn btn-default pull-right">Ver pedido</button></div>
        <div class="panel-body">
          Panel content
        </div>
      </div>
    </div> --}}


				</section>

		</div>







			</div>

						

					</div>

				</section>
@endsection