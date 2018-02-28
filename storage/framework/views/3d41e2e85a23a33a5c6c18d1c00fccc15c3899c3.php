<!DOCTYPE html>

<html lang="<?php echo e(config('app.locale')); ?>">

<head><meta http-equiv="Content-Type" content="text/html; charset=shift_jis">

    

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>



    <!-- CSRF Token -->

    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">



    <title>TuFarmaciaLatina.com</title>



    <!-- Styles -->
    <!-- ByW -->
        <link href="css/byw.min.css" rel="stylesheet">

    <!--Import materialize.css-->
    

    <!--Let browser know website is optimized for mobile-->


    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/icon?family=Material+Icons">



    <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">



    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/css/responsive.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/bootstrap.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/main.css')); ?>"/>
    <link href="js/plugins/owl-carousel/owl.carousel.css" rel="stylesheet">
    <link href="js/plugins/owl-carousel/owl.theme.css" rel="stylesheet">
    <link href="js/plugins/magnific-popup/magnific-popup.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/fileinput.min.css')); ?>">
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('css/mdb.min.css')); ?>">
    <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>


    <!-- Scripts -->

    <script>

        window.Laravel = <?php echo json_encode([

            'csrfToken' => csrf_token(),

        ]); ?>;

    </script>


</head>

<body class="landing">



<div id="page-wrapper">

    <header id="header" style="position: fixed !important">

        <h1 id="logo"><a href="<?php echo e(url('/')); ?>">Inicio</a></h1>

        <nav id="nav">

            <ul style="font-size: 12px;">

                <li>





                    <?php echo Form::open(['url' => '/Products1', 'method' => 'GET', 'class' => 'navbar-form pull-left']); ?>


                    <div class="form-group">

                        <?php echo Form::text ('title', null, ['id'=> 'title', 'class' => 'form-control btn-search autocomplete', 'placeholder' => 'buscar tu medicamento']); ?>


                    </div>

                    <button type="submit" class="btn btn-default btn-search2" id="search" aria-hidden="true">Buscar

                    </button>



                    <?php echo Form::close(); ?>


                    <a id="carrito" href="<?php echo e(url('/carrito')); ?>"><i class="fa fa-cart-plus blue" aria-hidden="true"></i>

                        <?php echo e($productsCount); ?></a></li>
            
                <li>

                 <?php if(Request::is('/')): ?>

                 <a class="product1" href="#productos">Productos</a>

                 <?php else: ?>

                 <a class="product1" href="<?php echo e(url('/Products1')); ?>">Productos</a>

                 <?php endif; ?>                        

                </li>



                <li>

                    <a class="product1" href="<?php echo e(url('/promotion')); ?>">Promociones</a>

                </li>



                <?php if(Auth::check() && Auth::user()->rol == 'admin'): ?>

                    <li>

                        <a class="product1" href="<?php echo e(url('/admin/sales')); ?>">Productos Vendidos</a>

                    </li>

                <?php else: ?>

                     <li>

                            <a class="product1" href="<?php echo e(url('/nosotros')); ?>">Nosotros</a>

                        </li>

                <?php endif; ?>



                <?php if(Auth::check() && Auth::user()->rol == 'admin'): ?>

                    <li>

                        <a class="product1" href="<?php echo e(url('/orders')); ?>">Ordenes</a>

                    </li>

                <?php endif; ?>



                <?php if(Auth::check() && Auth::user()->rol == 'admin'): ?>

                    <li>

                        <a class="product1" href="<?php echo e(url('/admin/recetas')); ?>">Recetas</a>

                    </li>

                <?php endif; ?>



                <?php if(Auth::guest()): ?>

                    <li><a href="<?php echo e(route('login')); ?>">Ingresar</a></li>

                    <li><a class="button special" href="<?php echo e(route('register')); ?>">Registrate</a></li>

                <?php else: ?>



                    <li>

                        <div class="dropdown">

                            <button class="btn btn-primary dropdown-toggle" type="button"

                                    data-toggle="dropdown"> <?php echo e(Auth::user()->name); ?>


                            </button>

                            <ul class="dropdown-menu dropdown1">

                                <li role="presentation">

                                    <a href="<?php echo e(route('logout')); ?>"

                                       onclick="event.preventDefault();

                                                         document.getElementById('logout-form').submit();">

                                        Cerrar Sesion

                                    </a>




                                   
                                </li>
                                <li>

                                    <a href="<?php echo e(url('user')); ?>">Mi perfil</a>

                                </li>



                            </ul>

                        </div>

                    </li>





                <?php endif; ?>

            </ul>

        </nav>
        
    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST"

          style="display: none;">

        <?php echo e(csrf_field()); ?>


    </form>
    </header>
    <div class="compras1" id="compras1">
        <?php if($productsCount != 0): ?>
            
        <div style="margin-left: 155px"><strong>EN TU CARRITO:</strong></div>
        <?php else: ?>
            
        <?php endif; ?>
        <?php $__currentLoopData = $shopping_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element => $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            
        <div class="container">
            <h5>
            <?php if($producto->extension): ?>

                <img class="img-circle" src="<?php echo e(url("/img_prod/$producto->id.$producto->extension")); ?>"  style="display: inline-block;" height="42" width="42">
            <?php else: ?>

                <img class="img-circle" src="<?php echo e(asset('img/12.jpg')); ?>" style="display: inline-block;" height="42" width="42">
            <?php endif; ?>

            <?php echo e($element+1); ?>.-  <?php echo e($producto->title); ?> 
            </h5></div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
                

    <span class="ir-arriba fa fa-arrow-up">

            


        </span>
        
    <?php echo $__env->yieldContent('content'); ?>
         





    <footer id="footer">

         

        <div class="column_footer"> 

        <ul class="static">

                <li><a href="<?php echo e(url('/faq')); ?>" class=""><span class="label">Preguntas Frecuentes</span></a></li>

                <br>

                <li><a href="<?php echo e(url('/nosotros')); ?>" class=""><span class="label">Nosotros</span></a></li>

                <br>

                <li><a href="<?php echo e(url('/privacidad')); ?>" class=""><span class="label">Aviso de Privacidad</span></a></li>

                <br>

                <li><a href="<?php echo e(url('/contact')); ?>" class=""><span class="label">Contactanos</span></a></li>

                </ul>

                <ul class="icons">

                    <li><h3>CONTÁCTANOS</h3></li><br>

                    <li><span>01 800 269 980 1</span></li>

                    <li><span>info@tufarmacialatina.com</span></li>

                </ul>

                <ul class="copyright">

                    <li><img src="<?php echo e(asset('img/pp.png')); ?>" alt=""></li>

                </ul>

        </div>

       <ul class="copyright">


                    <li>&copy; Untitled. All rights reserved.</li>

                    <li>© 2017 RX LATIN MED</li>

                </ul>



    </footer>
</div>

<!-- Scripts -->



<script src="<?php echo e(url('/js/jquery.min.js')); ?>"></script>
<script src="<?php echo e(url('/js/jquery-1.12.4.min.js')); ?>"></script>
<script src="<?php echo e(url('/js/jquery-ui.js')); ?>"></script>

<!--Import jQuery before materialize.js-->
 <script type="text/javascript" src="<?php echo e(url('js/jquery-3.1.1.min.js')); ?>"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>

<script src="<?php echo e(url('/js/editable.js')); ?>"></script>

<script src="<?php echo e(url('/js/app.js')); ?>"></script>

<script>

   $(document).ready(function(){
     $( "#title" ).autocomplete({
        // alert(products);
          source: function(request, response) {
        $.ajax({
            url: "/productslist",
            type: "GET",
            dataType:"json",
            data:{products: this.term},
            success: function (datos){
                 response( $.map( datos, function( item ) {
                return {label: item.title, value: item.title, url: item.id};}));
            }
        });
        },
          
          select: function(event, ui){
            $("#title").val(ui.item.label);
            window.location.href = "products/"+ui.item.url;
            
            
          }
        });
    });
    $(document).ready(function(){
        $("#carrito").hover(function() {
            $("#compras1").show();
            }, function(){
            $("#compras1").hide();                            
        });
    });
    // function productos(){
    //     console.log(<?php echo e($shopping_products); ?>);
    // }

        
    // var availableTags = [
    //   "ActionScript",
    //   "AppleScript",
    //   "Asp",
    //   "BASIC",
    //   "C",
    //   "C++",
    //   "Clojure",
    //   "COBOL",
    //   "ColdFusion",
    //   "Erlang",
    //   "Fortran",
    //   "Groovy",
    //   "Haskell",
    //   "Java",
    //   "JavaScript",
    //   "Lisp",
    //   "Perl",
    //   "PHP",
    //   "Python",
    //   "Ruby",
    //   "Scala",
    //   "Scheme"
    // ];
    // console.log(products);
  </script>



<?php echo $__env->yieldContent('scripts'); ?>

</body>

</html>

