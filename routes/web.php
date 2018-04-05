<?php



/*

|--------------------------------------------------------------------------

| Web Routes

|--------------------------------------------------------------------------

|

| Here is where you can register web routes for your application. These

| routes are loaded by the RouteServiceProvider within a group which

| contains the "web" middleware group. Now create something great!

|Route::get('/', function () {

    return view('welcome');

});



*/

Route::get('/', 'MainController@home');

Route::get('/carrito', 'ShoppingCartsController@index');

Route::post('/carrito', 'ShoppingCartsController@checkout');

Route::get('/payments/store', 'PaymentsController@store');
Route::get('downloadFile','DownloadController@downloadFile');    



Auth::routes();



Route::get('/home', 'HomeController@index');
Route::get('/productslist','MainController@productlist');





Route::resource('in_shopping_carts', 'InShoppingCartsController', [

    'only' => ['store', 'destroy']

]);

Route::resource('shopping_carts', 'ShoppingCartsController', [

    'only' => ['show', 'destroy']

]);



Route::get('/Products1', "ProductsController@statics");

//Route::get('/promotions', 'PromotionsController@index');



Route::get('/nosotros', function () {

    return view('static/nosotros');

});

Route::get('/privacidad', function () {

    return view('static/Priv');

});

Route::get('/seguimiento', function () {

    return view('static/seguimiento');

});

Route::get('/servicios', function () {

    return view('static/servicios');
});

Route::get('/faq', function () {

    return view('static/faq');

});

Route::resource('/products', 'ProductsController');







Route::get('/creardireccion', 'Direccions@creardireccioninvitado');



Route::post('/user/direccion/create', 'Direccions@store');

Route::get('buscartracking', 'ShoppingCartsController@buscar');




#rutas para form contact

Route::get('contact', 

  ['as' => 'contact', 'uses' => 'AboutController@create']);

Route::post('contact', 

  ['as' => 'contact_store', 'uses' => 'AboutController@store']);

  

Route::get('products/images/{filename}', function ($filename) {

    $path = storage_path("app/images/$filename");
    // dd($path);



    if (!\File::exists($path)) abort(404);



    $file = \File::get($path);



    $type = \File::mimeType($path);



    $response = Response::make($file, 200);



    $response->header("Content-Type", $type);



    return $response;



});



Route::resource('compras', 'ShoppingCartsController', [

    'only' => ['show']

]);
Route::get('pedido/{id}','ShoppingCartsController@pedido');


Route::group(['middleware' => 'auth'], function () {

    Route::group(['middleware' => ['isAdmin']], function () {



        Route::get('/admin/sales', 'Admin\SalesController@getIndex');

        // Route::get('/admin/sales/excel', 'Admin\SalesController@excel');

        Route::resource('/orders', 'OrdersController', [

            'only' => ['index', 'update']

        ]);

        Route::get('/order/info_address/{shoppingcart}', 'OrdersController@getAddressInfo');



        Route::get('/admin/recetas', 'Admin\RecetasController@getIndex');

        Route::resource('tracking','Tracking\TrackingController');
        Route::resource('status','Tracking\StatusTrackingController');

        Route::get('/promotions', 'PromotionsController@index');


        // Route::get('user', "userprofileController@user");

        // Route::get('user/profile', "userprofileController@profile");

        // Route::post('user/updateprofile', "userprofileController@updateprofile");

        // Route::get('user/password', 'userprofileController@password');

        // Route::post('user/updatepassword', 'userprofileController@updatePassword');



        // //Route::resource('user/direccion', 'Direccions');

        // Route::get('/user/direccion', 'Direccions@index');

        // Route::get('/user/direccion/create', 'Direccions@create');

        // Route::post('/user/direccion/set_default', 'Direccions@setDefault');



        // #rutas para los productos favoritos

        // Route::get('/user/my-favorite-products', 'FavoriteProductsController@index');

        // Route::get('/user/product/{product_id}/favorite/remove', 'FavoriteProductsController@addremove');

        // Route::get('/user/product/{product_id}/favorite/add', 'FavoriteProductsController@addremove');



        // #rutas para ver las ordenes de un usuario

        // Route::get('/user/my-orders', 'UserOrdersController@index');



        // #ruta para obtener la imagen de una receta

        // Route::post('/user/order/get-receta', 'UserOrdersController@getReceta');



        // #rutas para comentar un producto

        // Route::get('/user/product/{product_id}/comment', 'ProductCommentController@getIndex');

        // Route::post('/user/product/comment', 'ProductCommentController@storeComment');

    });

    Route::get('user', "userprofileController@user");

    Route::get('user/profile', "userprofileController@profile");

    Route::post('user/updateprofile', "userprofileController@updateprofile");

    Route::get('user/password', 'userprofileController@password');

    Route::post('user/updatepassword', 'userprofileController@updatePassword');



    //Route::resource('user/direccion', 'Direccions');

    Route::get('/user/direccion', 'Direccions@index');

    Route::get('/user/direccion/create', 'Direccions@create');

    Route::post('/user/direccion/set_default', 'Direccions@setDefault');



    #rutas para los productos favoritos

    Route::get('/user/my-favorite-products', 'FavoriteProductsController@index');

    Route::get('/user/product/{product_id}/favorite/remove', 'FavoriteProductsController@addremove');

    Route::get('/user/product/{product_id}/favorite/add', 'FavoriteProductsController@addremove');



    #rutas para ver las ordenes de un usuario

    Route::get('/user/my-orders', 'UserOrdersController@index');



    #ruta para obtener la imagen de una receta

    Route::post('/user/order/get-receta', 'UserOrdersController@getReceta');



    #rutas para comentar un producto

    Route::get('/user/product/{product_id}/comment', 'ProductCommentController@getIndex');

    Route::post('/user/product/comment', 'ProductCommentController@storeComment');

});


/*

 * rutas solamente para usuarios admin check middleware

 */

Route::group(['middleware' => ['isAdmin']], function () {



    Route::get('/admin/sales', 'Admin\SalesController@getIndex');

    // Route::get('/admin/sales/excel', 'Admin\SalesController@excel');

    Route::resource('/orders', 'OrdersController', [

        'only' => ['index', 'update']

    ]);

    Route::get('/order/info_address/{shoppingcart}', 'OrdersController@getAddressInfo');
    Route::get('/order/info_shopping/{shoppingcart}', 'OrdersController@shoppingInfo');



    Route::get('/admin/recetas', 'Admin\RecetasController@getIndex');

    Route::resource('tracking','Tracking\TrackingController');
    Route::get('buscartraking','Tracking\TrackingController@search');
    Route::resource('status','Tracking\StatusTrackingController');

    Route::get('/promotions', 'PromotionsController@index');

    Route::post('moneda', 'CambioMonedaController@store');
    Route::get('/ordens', 'OrdersController@getOrden');
    Route::resource('envios','ZonaEnvio\ZonaEnvioController');

    // Route::get('user', "userprofileController@user");

    // Route::get('user/profile', "userprofileController@profile");

    // Route::post('user/updateprofile', "userprofileController@updateprofile");

    // Route::get('user/password', 'userprofileController@password');

    // Route::post('user/updatepassword', 'userprofileController@updatePassword');



    // //Route::resource('user/direccion', 'Direccions');

    // Route::get('/user/direccion', 'Direccions@index');

    // Route::get('/user/direccion/create', 'Direccions@create');

    // Route::post('/user/direccion/set_default', 'Direccions@setDefault');



    // #rutas para los productos favoritos

    // Route::get('/user/my-favorite-products', 'FavoriteProductsController@index');

    // Route::get('/user/product/{product_id}/favorite/remove', 'FavoriteProductsController@addremove');

    // Route::get('/user/product/{product_id}/favorite/add', 'FavoriteProductsController@addremove');



    // #rutas para ver las ordenes de un usuario

    // Route::get('/user/my-orders', 'UserOrdersController@index');



    // #ruta para obtener la imagen de una receta

    // Route::post('/user/order/get-receta', 'UserOrdersController@getReceta');



    // #rutas para comentar un producto

    // Route::get('/user/product/{product_id}/comment', 'ProductCommentController@getIndex');

    // Route::post('/user/product/comment', 'ProductCommentController@storeComment');

});
// Route::get('excel','FileController@importarExcel')->name('excel.import');
// Route::post('import-csv-excel', 'FileController@importFileIntoDB')->name('import-csv-excel');

Route::get('/promovisita', 'PromotionsController@visita');

Route::get('/promotion', function () {
   
})->middleware(PromoChk::class);


