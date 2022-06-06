<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PriceTypeController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::controller(ProductController::class)->prefix('products')->as('products.')->group(function () {

    Route::get('/', 'index')->name('index');
    Route::post('/', 'store')->name('store');

    Route::get('/create', 'create')->name('create');

    Route::get('/{product}', 'show')->name('show');
    Route::patch('/{product}', 'update')->name('update');
    Route::delete('/{product}', 'destroy')->name('destroy');
    Route::post('/product/price-list/{price_id}', 'priceListDestroy')->name('priceListDestroy');

    Route::get('/{product}/edit', 'edit')->name('edit');
    Route::get('/{product}/change-status', 'changeStatus')->name('changeStatus');

});

Route::controller(CategoryController::class)->prefix('categories')->as('categories.')->group(function () {

    Route::get('/', 'index')->name('index');
    Route::post('/', 'store')->name('store');

    Route::get('/create', 'create')->name('create');

    Route::get('/{category}', 'show')->name('show');
    Route::patch('/{category}', 'update')->name('update');
    Route::delete('/{category}', 'destroy')->name('destroy');

    Route::get('/{category}/edit', 'edit')->name('edit');
    Route::get('/{category}/change-status', 'changeStatus')->name('changeStatus');

});

Route::controller(PriceTypeController::class)->prefix('price-type')->as('priceTypes.')->group(function () {

    Route::get('/', 'index')->name('index');
    Route::post('/', 'store')->name('store');

    Route::get('/create', 'create')->name('create');

    Route::get('/{priceType}', 'show')->name('show');
    Route::patch('/{priceType}', 'update')->name('update');
    Route::delete('/{priceType}', 'destroy')->name('destroy');

    Route::get('/{priceType}/edit', 'edit')->name('edit');
    Route::get('/{priceType}/change-status', 'changeStatus')->name('changeStatus');

});

Route::controller(OrderController::class)->prefix('orders')->as('orders.')->group(function () {

    Route::get('/', 'index')->name('index');
    
    Route::get('/{order}', 'show')->name('show');
    Route::post('/{order}', 'update')->name('update');

    Route::patch('/changeDeliveryStatus', 'changeDeliveryStatus')->name('changeDeliveryStatus');

});