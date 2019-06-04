<?php

Route::get('/', function (){
    return view('backoffice.template.base');
})->name('backoffice');

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
