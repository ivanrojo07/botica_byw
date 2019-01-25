@extends("layouts.app")
@section("content")
    <div class="big-padding text-center blue-grey white-text" style="    padding-top: 65px !important;">
        <h1>Tu carrito de compras</h1>
    </div>
    <div class="container margin-top">
        <table class="table table-responsive-md table-bordered">
            <thead>
            <tr>
                <th scope="col">
                    <strong>Producto</strong>
                </th>
                <th scope="col">
                    <strong>Precio</strong>
                </th>
                <th scope="col">
                    <strong>Cantidad</strong>
                </th>
                <th scope="col">
                    <strong>Subtotal</strong>
                </th>
                <th scope="col">
                    <strong></strong>
                </th>
            </tr>
            </thead>
            <tbody>
                {{-- {{dd($envio)}} --}}
            @foreach($products as $product)
                <tr>
                    <td>
                        {{$product->descripcion}}
                        @if(is_object($product->cat) && $product->cat->slug == 'Promociones')
                            <label class="text-info">(Producto en Promoción)</label>
                        @endif
                    </td>
                    <td>
                        @if(is_object($product->cat) && $product->cat->slug == 'Promociones')
                            $ {{$product->promotion_pricing}}
                        @else
                            $ {{$product->pivot->preciounit}}
                        @endif


                    </td>
                    <td>
                        {{ $product->pivot->qty }}
                    </td>
                    <td>
                        $ {{ number_format($product->pivot->qty * ((is_object($product->cat) && $product->cat->slug == 'Promociones') ? $product->promotion_pricing : $product->pivot->preciounit), 2) }} USD
                    </td>
                    <td>
                        @include("shopping_carts.delete")
                    </td>
                </tr>
            @endforeach
            @foreach($promotions as $product)
                <tr>
                    <td>
                        {{$product->nombre}}
                            <label class="text-info">(Producto en Promoción)</label>
                    </td>
                    <td>
                        @if(is_object($product->cat) && $product->cat->slug == 'Promociones')
                            $ {{$product->promotion_pricing}}
                        @else
                            $ {{$product->pivot->preciounit}}
                        @endif
                    </td>
                    <td>
                        {{ $product->pivot->qty }}
                    </td>
                    <td>
                        $ {{ number_format($product->pivot->qty * ((is_object($product->cat) && $product->cat->slug == 'Promociones') ? $product->promotion_pricing : $product->pivot->preciounit), 2) }}
                    </td>
                    <td>
                        @include("shopping_carts.delete_promotion")
                    </td>
                </tr>
            @endforeach
            <tbody id="envios">
            </tbody>
            </tbody>
        </table>
        <div>
            @include("shopping_carts.form")
        </div>
        <p class="text-center" style="color: black;"><strong>El tiempo estimado de la entrega es de 5 a 7 dias habiles</strong></p>
    </div>
@endsection
@section('scripts')
    {{-- expr --}}
    
    
    
    <script src="{{ asset('js/plugins/piexif.min.js') }}"></script>
    
    <link href="{{ asset('css/fileinput.css') }}" media="all" rel="stylesheet" type="text/css"/>
   
    <script src="{{ asset('js/plugins/sortable.min.js') }}"></script>
    <script src="{{ asset('js/fileinput.min.js') }}"></script>
    <script src="{{ asset('js/locales/es.js') }}"></script>
    <script src="{{ asset('themes/explorer-fa/theme.js')}}" type="text/javascript"></script>
    <script src="{{ asset('themes/fa/theme.js')}}" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" type="text/javascript"></script>

    {{-- @if (Auth::check())
        <script>
            $(document).ready(function(){
                direccion = $('input[name=direccion_default]:checked').val();
                console.log(direccion);
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url:"http://country.io/phone.json",
                    type: "GET",
                    dataType:"application/json",
                    success:function (data) {
                        console.log("country ",data);
                    }
                })
                $.ajax({
                    url: "{{ url('/envioshopping') }}",
                    type: "POST",
                    // dataType: "html",
                    data: {
                        direccion_id: direccion,
                        envio_id: {{$envio->id}},
                        total: {{$total}},
                    },
                    success: function(data){
                        $('#envios').html(data);
                    }
                });
                $('input[name=direccion_default]').change(function(){
                    direccion = $('input[name=direccion_default]:checked').val();
                    $.ajax({
                        url: "{{ url('/envioshopping') }}",
                        type: "POST",
                        // dataType: "html",
                        data: {
                            direccion_id: $('input[name=direccion_default]:checked').val(),
                            envio_id: {{$envio->id}},
                            total: {{$total}},
                        },
                        success: function(data){
                            $('#envios').html(data);
                        }
                    });
                });

            });
            
        </script>
    @else
        <script>
            $(document).ready(function(){
            
                direccion = {{ isset($direccion_default->id) ? "$direccion_default->id" : "$('input[name=direccion_default]:checked').val()"}};
                console.log(direccion);
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ url('/envioshopping') }}",
                    type: "POST",
                    // dataType: "html",
                    data: {
                        direccion_id: direccion,
                        envio_id: {{$envio->id}},
                        total: {{$total}},
                    },
                    success: function(data){
                        $('#envios').html(data);
                    }
                });
                $('input[name=direccion_default]').change(function(){
                    direccion = $('input[name=direccion_default]:checked').val();
                    $.ajax({
                        url: "{{ url('/envioshopping') }}",
                        type: "POST",
                        // dataType: "html",
                        data: {
                            direccion_id: $('input[name=direccion_default]:checked').val(),
                            envio_id: {{$envio->id}},
                            total: {{$total}},
                        },
                        success: function(data){
                            $('#envios').html(data);
                        }
                    });
                });

            });
        </script>
    @endif --}}
    <script>
        $('#receta').fileinput({
            theme: 'fa',
            language: 'es',
            showUpload: false,
            required: true,
            allowedFileExtensions: ["pdf", "jpg", "jpeg", "png"],
        });
        $('#receta').change(function(){
           
        });
    </script>
    <script type="text/javascript">
        var codigos =[{pais:"BD", codigo:"880"},{pais:"BE", codigo:"32"},{pais:"BF", codigo:"226"},{pais:"BG", codigo:"359"},{pais:"BA", codigo:"387"},{pais:"BB", codigo:"+1-246"},{pais:"WF", codigo:"681"},{pais:"BL", codigo:"590"},{pais:"BM", codigo:"+1-441"},{pais:"BN", codigo:"673"},{pais:"BO", codigo:"591"},{pais:"BH", codigo:"973"},{pais:"BI", codigo:"257"},{pais:"BJ", codigo:"229"},{pais:"BT", codigo:"975"},{pais:"JM", codigo:"+1-876"},{pais:"BV", codigo:""},{pais:"BW", codigo:"267"},{pais:"WS", codigo:"685"},{pais:"BQ", codigo:"599"},{pais:"BR", codigo:"55"},{pais:"BS", codigo:"+1-242"},{pais:"JE", codigo:"+44-1534"},{pais:"BY", codigo:"375"},{pais:"BZ", codigo:"501"},{pais:"RU", codigo:"7"},{pais:"RW", codigo:"250"},{pais:"RS", codigo:"381"},{pais:"TL", codigo:"670"},{pais:"RE", codigo:"262"},{pais:"TM", codigo:"993"},{pais:"TJ", codigo:"992"},{pais:"RO", codigo:"40"},{pais:"TK", codigo:"690"},{pais:"GW", codigo:"245"},{pais:"GU", codigo:"+1-671"},{pais:"GT", codigo:"502"},{pais:"GS", codigo:""},{pais:"GR", codigo:"30"},{pais:"GQ", codigo:"240"},{pais:"GP", codigo:"590"},{pais:"JP", codigo:"81"},{pais:"GY", codigo:"592"},{pais:"GG", codigo:"+44-1481"},{pais:"GF", codigo:"594"},{pais:"GE", codigo:"995"},{pais:"GD", codigo:"+1-473"},{pais:"GB", codigo:"44"},{pais:"GA", codigo:"241"},{pais:"SV", codigo:"503"},{pais:"GN", codigo:"224"},{pais:"GM", codigo:"220"},{pais:"GL", codigo:"299"},{pais:"GI", codigo:"350"},{pais:"GH", codigo:"233"},{pais:"OM", codigo:"968"},{pais:"TN", codigo:"216"},{pais:"JO", codigo:"962"},{pais:"HR", codigo:"385"},{pais:"HT", codigo:"509"},{pais:"HU", codigo:"36"},{pais:"HK", codigo:"852"},{pais:"HN", codigo:"504"},{pais:"HM", codigo:" "},{pais:"VE", codigo:"58"},{pais:"PR", codigo:"+1-787 and 1-939"},{pais:"PS", codigo:"970"},{pais:"PW", codigo:"680"},{pais:"PT", codigo:"351"},{pais:"SJ", codigo:"47"},{pais:"PY", codigo:"595"},{pais:"IQ", codigo:"964"},{pais:"PA", codigo:"507"},{pais:"PF", codigo:"689"},{pais:"PG", codigo:"675"},{pais:"PE", codigo:"51"},{pais:"PK", codigo:"92"},{pais:"PH", codigo:"63"},{pais:"PN", codigo:"870"},{pais:"PL", codigo:"48"},{pais:"PM", codigo:"508"},{pais:"ZM", codigo:"260"},{pais:"EH", codigo:"212"},{pais:"EE", codigo:"372"},{pais:"EG", codigo:"20"},{pais:"ZA", codigo:"27"},{pais:"EC", codigo:"593"},{pais:"IT", codigo:"39"},{pais:"VN", codigo:"84"},{pais:"SB", codigo:"677"},{pais:"ET", codigo:"251"},{pais:"SO", codigo:"252"},{pais:"ZW", codigo:"263"},{pais:"SA", codigo:"966"},{pais:"ES", codigo:"34"},{pais:"ER", codigo:"291"},{pais:"ME", codigo:"382"},{pais:"MD", codigo:"373"},{pais:"MG", codigo:"261"},{pais:"MF", codigo:"590"},{pais:"MA", codigo:"212"},{pais:"MC", codigo:"377"},{pais:"UZ", codigo:"998"},{pais:"MM", codigo:"95"},{pais:"ML", codigo:"223"},{pais:"MO", codigo:"853"},{pais:"MN", codigo:"976"},{pais:"MH", codigo:"692"},{pais:"MK", codigo:"389"},{pais:"MU", codigo:"230"},{pais:"MT", codigo:"356"},{pais:"MW", codigo:"265"},{pais:"MV", codigo:"960"},{pais:"MQ", codigo:"596"},{pais:"MP", codigo:"+1-670"},{pais:"MS", codigo:"+1-664"},{pais:"MR", codigo:"222"},{pais:"IM", codigo:"+44-1624"},{pais:"UG", codigo:"256"},{pais:"TZ", codigo:"255"},{pais:"MY", codigo:"60"},{pais:"MX", codigo:"52"},{pais:"IL", codigo:"972"},{pais:"FR", codigo:"33"},{pais:"IO", codigo:"246"},{pais:"SH", codigo:"290"},{pais:"FI", codigo:"358"},{pais:"FJ", codigo:"679"},{pais:"FK", codigo:"500"},{pais:"FM", codigo:"691"},{pais:"FO", codigo:"298"},{pais:"NI", codigo:"505"},{pais:"NL", codigo:"31"},{pais:"NO", codigo:"47"},{pais:"NA", codigo:"264"},{pais:"VU", codigo:"678"},{pais:"NC", codigo:"687"},{pais:"NE", codigo:"227"},{pais:"NF", codigo:"672"},{pais:"NG", codigo:"234"},{pais:"NZ", codigo:"64"},{pais:"NP", codigo:"977"},{pais:"NR", codigo:"674"},{pais:"NU", codigo:"683"},{pais:"CK", codigo:"682"},{pais:"XK", codigo:""},{pais:"CI", codigo:"225"},{pais:"CH", codigo:"41"},{pais:"CO", codigo:"57"},{pais:"CN", codigo:"86"},{pais:"CM", codigo:"237"},{pais:"CL", codigo:"56"},{pais:"CC", codigo:"61"},{pais:"CA", codigo:"1"},{pais:"CG", codigo:"242"},{pais:"CF", codigo:"236"},{pais:"CD", codigo:"243"},{pais:"CZ", codigo:"420"},{pais:"CY", codigo:"357"},{pais:"CX", codigo:"61"},{pais:"CR", codigo:"506"},{pais:"CW", codigo:"599"},{pais:"CV", codigo:"238"},{pais:"CU", codigo:"53"},{pais:"SZ", codigo:"268"},{pais:"SY", codigo:"963"},{pais:"SX", codigo:"599"},{pais:"KG", codigo:"996"},{pais:"KE", codigo:"254"},{pais:"SS", codigo:"211"},{pais:"SR", codigo:"597"},{pais:"KI", codigo:"686"},{pais:"KH", codigo:"855"},{pais:"KN", codigo:"+1-869"},{pais:"KM", codigo:"269"},{pais:"ST", codigo:"239"},{pais:"SK", codigo:"421"},{pais:"KR", codigo:"82"},{pais:"SI", codigo:"386"},{pais:"KP", codigo:"850"},{pais:"KW", codigo:"965"},{pais:"SN", codigo:"221"},{pais:"SM", codigo:"378"},{pais:"SL", codigo:"232"},{pais:"SC", codigo:"248"},{pais:"KZ", codigo:"7"},{pais:"KY", codigo:"+1-345"},{pais:"SG", codigo:"65"},{pais:"SE", codigo:"46"},{pais:"SD", codigo:"249"},{pais:"DO", codigo:"+1-809 and 1-829"},{pais:"DM", codigo:"+1-767"},{pais:"DJ", codigo:"253"},{pais:"DK", codigo:"45"},{pais:"VG", codigo:"+1-284"},{pais:"DE", codigo:"49"},{pais:"YE", codigo:"967"},{pais:"DZ", codigo:"213"},{pais:"US", codigo:"1"},{pais:"UY", codigo:"598"},{pais:"YT", codigo:"262"},{pais:"UM", codigo:"1"},{pais:"LB", codigo:"961"},{pais:"LC", codigo:"+1-758"},{pais:"LA", codigo:"856"},{pais:"TV", codigo:"688"},{pais:"TW", codigo:"886"},{pais:"TT", codigo:"+1-868"},{pais:"TR", codigo:"90"},{pais:"LK", codigo:"94"},{pais:"LI", codigo:"423"},{pais:"LV", codigo:"371"},{pais:"TO", codigo:"676"},{pais:"LT", codigo:"370"},{pais:"LU", codigo:"352"},{pais:"LR", codigo:"231"},{pais:"LS", codigo:"266"},{pais:"TH", codigo:"66"},{pais:"TF", codigo:""},{pais:"TG", codigo:"228"},{pais:"TD", codigo:"235"},{pais:"TC", codigo:"+1-649"},{pais:"LY", codigo:"218"},{pais:"VA", codigo:"379"},{pais:"VC", codigo:"+1-784"},{pais:"AE", codigo:"971"},{pais:"AD", codigo:"376"},{pais:"AG", codigo:"+1-268"},{pais:"AF", codigo:"93"},{pais:"AI", codigo:"+1-264"},{pais:"VI", codigo:"+1-340"},{pais:"IS", codigo:"354"},{pais:"IR", codigo:"98"},{pais:"AM", codigo:"374"},{pais:"AL", codigo:"355"},{pais:"AO", codigo:"244"},{pais:"AQ", codigo:""},{pais:"AS", codigo:"+1-684"},{pais:"AR", codigo:"54"},{pais:"AU", codigo:"61"},{pais:"AT", codigo:"43"},{pais:"AW", codigo:"297"},{pais:"IN", codigo:"91"},{pais:"AX", codigo:"+358-18"},{pais:"AZ", codigo:"994"},{pais:"IE", codigo:"353"},{pais:"ID", codigo:"62"},{pais:"UA", codigo:"380"},{pais:"QA", codigo:"974"},{pais:"MZ", codigo:"258"}];
        $(document).ready(function(){
            // console.log(codigos);
             codigos.forEach(function(codigo){
                $("#codigo_pais").append(`<option value="${codigo.codigo}">${codigo.pais} ${codigo.codigo}</option>`);
             })

        });
    </script>
@endsection

