<?php

Route::get('/', 'DashboardController@index')->name('backoffice');

Route::get('/login', 'LoginController@showLogin')->name('backoffice.login.show');
Route::post('/login', 'LoginController@login')->name('backoffice.login');
Route::get('/login/send-password', 'LoginController@showSendPassword')->name('backoffice.login.show-send-password');
Route::post('/login/send-password', 'LoginController@sendPassword')->name('backoffice.login.send-password');
Route::get('/login/recovery-password', 'LoginController@showRecoveryPassword')->name('backoffice.login.show-recovery-password');
Route::post('/login/recovery-password', 'LoginController@recoveryPassword')->name('backoffice.login.recovery-password');


Route::group(['middleware' => 'web'], function () {
    Route::resourceVerbs([
        'create' => 'crear',
        'edit' => 'editar',
        'change-status' => 'cambiar-estado',
    ]);

    Route::resource('catalogo/categorias', 'ProductCategoryController', ['as' => 'backoffice.catalogo'])->except(['show']);
    Route::post('catalogo/categorias/change-status', 'ProductCategoryController@changeStatus')->name('backoffice.catalogo.categorias.change-status');

    Route::resource('catalogo/productos', 'ProductController', ['as' => 'backoffice.catalogo'])->except(['show']);
    Route::post('catalogo/productos/change-status', 'ProductController@changeStatus')->name('backoffice.catalogo.productos.change-status');

    Route::resource('pedidos', 'OrderController', ['as' => 'backoffice'])->only(['index']);
    Route::post('pedidos/change-status', 'OrderController@changeStatus')->name('backoffice.pedidos.change-status');
});
