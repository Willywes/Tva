<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'Frontend\IndexController@index')->name('init');

Route::get('/pro', 'Frontend\IndexController@pro')->name('pro');

Route::post('/login', 'Frontend\AuthController@login')->name('login');
Route::get('/logout', 'Frontend\AuthController@logout')->name('logout');

Route::get('carrito', 'Frontend\CartController@index')->name('cart');


Route::group(['prefix' => 'perfil'], function () {
    Route::get('pedidos', 'Frontend\CustomerController@orders')->name('profile.orders');
    Route::get('direcciones', 'Frontend\CustomerController@addresses')->name('profile.addresses');
    Route::get('get-addresses', 'Frontend\CustomerController@getAddresses')->name('profile.get_addresses');
    Route::post('add-address', 'Frontend\CustomerController@addAddress')->name('profile.add_address');
});

Route::group(['prefix' => 'pedido'], function () {
    Route::get('seleccionar-delivery', 'Frontend\CartController@selectDelivery')->name('order.select-delivery');
    Route::post('despachar-tipo', 'Frontend\CartController@dispatchDelivery')->name('order.dispatch-delivery');
    Route::get('despachar-tipo', function(){
        return redirect()->route('order.select-delivery');
    });
    Route::get('seleccionar-direccion', 'Frontend\CartController@selectAddress')->name('order.select-address');
    Route::post('cargar-direccion', 'Frontend\CartController@setDelivery')->name('order.load-direccion');
    Route::get('cargar-direccion', function(){
        return redirect()->route('order.select-delivery');
    });

    Route::get('finalizar', 'Frontend\CartController@finish')->name('order.finish');


});

//Route::get('test', ['middleware' => 'auth_cart', function () {
//    //return \App\Http\Controllers\Frontend\HelperFront::refuteAction();
//    return \App\Http\Controllers\Frontend\HelperFront::validateHorary();
//}]);
// ajax
Route::group(['prefix' => 'ajax'], function () {

//    Route::post('add-cart', 'Frontend\AjaxController@add_item_cart_customer')->name('ajax.add_item_cart_customer');
//    Route::post('update-cart', 'Frontend\AjaxController@update_cart_customer')->name('ajax.update_cart_customer');

    Route::get('producto/{id}', 'Frontend\ProductController@show')->name('ajax.product.show');
});

Route::group(['prefix' => 'cart'], function () {
    Route::get('get-cart', 'Frontend\CartController@getCart')->name('cart.get_cart');
    Route::post('add-cart', 'Frontend\CartController@addToCart')->name('cart.add_to_cart');
    Route::post('update-cart', 'Frontend\CartController@updateCart')->name('cart.update_cart');
    Route::post('remove-from-cart', 'Frontend\CartController@removeFromCart')->name('cart.remove_from_cart');

    Route::post('repeat-order', 'Frontend\CartController@repeatOrder')->name('cart.repeat_order');

});

Route::get('email', function (){

    return \App\Http\Controllers\Frontend\HelperFront::validateHorary();
//    $order = App\Models\Order::latest()->first();
//    \App\Http\Controllers\Frontend\HelperFront::sendMailCustomer($order->id);
//    return view('emails.mail', compact('order'));
});