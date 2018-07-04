@extends('layouts.app')
@section('content')
<section id="four" class="wrapper style1 special fade-up">
	<div class="container">
    <div id="productos" class="container">
  		<header class="major">
  			<img src="{{ asset('/img/sky.png') }}">
  			<br>
  			<br>
        <br>
  			<h2 class="grey satisfic-font font1">Aqui podras darle seguimiento a tu Pedido</h2>
  		</header>
  	</div>				
  @if (Auth::guest())
    <form name="buscar_tracking" id="buscar_tracking" method="GET" action="{{ url('/buscartracking') }}">
      <div class="input-group center">
        {{ csrf_field() }}
        <input type="text" class="form-control" name="tracking" placeholder="Introduce tu numero de orden" aria-describedby="basic-addon2" autofocus>
        <a onclick="document.getElementById('buscar_tracking').submit()" class="input-group-addon btn btn-success" id="basic-addon2"><i class="fa fa-search"></i></a>
      </div>
    </form>
  @else
    <h3 class="center">Consulta el status de tu paquete en este <a href="{{ url('/user/my-orders') }}">link</a>.</h3>
  @endif
  @if (isset($shopping_cart))
    {{-- true expr --}}
    {{-- {{dd($trackings)}} --}}
    @if (isset($trackings))
      @if ($trackings->count() == 0)
        {{-- expr --}}
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
                         <p class="col-lg-5 col-md-7">Número de Bultos: </p>
                        <p class="col-lg-5 col-md-7">Peso:  Kg.</p>
                      </div>
                    </div>
                </div>
                <div class="tracking col-lg-5 col-md-6 col-xs-12">
                  <p class="row">Paquetería: Sky Conexión</p>
                   
                        <ul id="tracking-events" class="tracking-events-container in">
                        
                          {{-- expr --}}
                          <li>
                              <span>{{$shopping_cart->created_at->format('d/m/Y')}} | {{$shopping_cart->created_at->format('H:i')}}</span>
                              <span>Validando tu orden</span>
                          </li>
                </ul>              
                </div>
              </div>
            </div>
        <br>
        <br>
        <br>
        <br>
        </section>
      </div>
      @endif
      {{-- true expr --}}
      @foreach ($trackings as $tracking)
      {{-- expr --}}
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
                          <li>
                              <span>{{$shopping_cart->created_at->format('d/m/Y')}} | {{$shopping_cart->created_at->format('H:i')}}</span>
                              <span>Validando tu orden</span>
                          </li>
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
        <br>
        <br>
        <br>
        <br>
        </section>
      </div>
      @endforeach
    @else
      {{-- false expr --}}
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
                      
                      </div>
                    </div>
                </div>
                <div class="tracking col-lg-5 col-md-6 col-xs-12">
                        <ul id="tracking-events" class="tracking-events-container in">
                        
                          {{-- expr --}}
                          <li>
                              <span>{{$shopping_cart->created_at->format('d/m/Y')}} | {{$shopping_cart->created_at->format('H:i')}}</span>
                              <span>Validando tu orden</span>
                          </li>
                            
                </ul>
                                   
                </div>
              </div>
            </div>

        <br>
        <br>
        <br>
        <br>
        </section>
      </div>
    @endif
    
  @else

  @endif

  
	</div>
</section>
@endsection