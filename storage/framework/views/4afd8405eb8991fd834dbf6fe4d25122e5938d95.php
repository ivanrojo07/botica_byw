<!DOCTYPE html>
<html lang="<?php echo e(config('app.locale')); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Laravel')); ?></title>

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/icon?family=Material+Icons">

    <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css"
          href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('css/main.css')); ?>"/>
    <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css"
          rel="stylesheet"/>


    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>;
    </script>

</head>
<body class="landing">

<div id="page-wrapper">
    <header id="header">
        <h1 id="logo"><a href="<?php echo e(url('/')); ?>">Inicio</a></h1>
        <nav id="nav">
            <ul>

                <li>


                    <?php echo Form::open(['url' => '/Products1', 'method' => 'GET', 'class' => 'navbar-form pull-left']); ?>

                    <div class="form-group">
                        <?php echo Form::text ('title', null, ['class' => 'form-control btn-search', 'placeholder' => 'buscar tu medicamento', 'aria-describedby' => 'search']); ?>

                    </div>
                    <button type="submit" class="btn btn-default btn-search2" id="search" aria-hidden="true">Buscar
                    </button>

                    <?php echo Form::close(); ?>

                    <a href="<?php echo e(url('/carrito')); ?>"><i class="fa fa-cart-plus blue" aria-hidden="true"></i>
                        <?php echo e($productsCount); ?></a></li>
                <li>
                 <?php if(Request::is('/')): ?>
                 <a class="product1" href="#productos">Productos</a>
                 <?php else: ?>
                 <a class="product1" href="<?php echo e(url('/Products1')); ?>">Productos</a>
                 <?php endif; ?>                        
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
                                <li>
                                    <a href="<?php echo e(route('logout')); ?>"
                                       onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                        Cerrar Sesion
                                    </a>

                                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST"
                                          style="display: none;">
                                        <?php echo e(csrf_field()); ?>

                                    </form>
                                </li>
                                <br>
                                <li>
                                    <a href="<?php echo e(url('user')); ?>">Mi perfil</a>
                                </li>

                            </ul>
                        </div>
                    </li>


                <?php endif; ?>
            </ul>
        </nav>
    </header>
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
                </ul>
                <ul class="icons">
                    <li><h3>CONTÁCTANOS</h3></li><br>
                    <li><span>01 800 269 980 1</span></li>
                    
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
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
<script src="<?php echo e(url('/js/editable.js')); ?>"></script>
<script src="<?php echo e(url('/js/app.js')); ?>"></script>
<?php echo $__env->yieldContent('scripts'); ?>
</body>
</html>
