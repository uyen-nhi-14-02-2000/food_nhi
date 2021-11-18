<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

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

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/link-storage', function () {
    Artisan::call('storage:link');
});

Route::middleware(['auth'])->group(function () {
    Route::redirect('/dashboard', '/menu')->name('home');
    Route::prefix('menu')->name('menu.')->group(function () {
        Route::get('/', 'MenuController@index')->name('index');
        Route::post('/search', 'MenuController@search')->name('search');
        Route::post('/detail/{id}', 'MenuController@detail')->name('detail');
        Route::post('/get-data', 'MenuController@getData')->name('get-data');
    });
    Route::prefix('cart')->name('cart.')->group(function () {
        // Route::get('/', 'CartController@index')->name('index');
        // Route::post('/search', 'MenuController@search')->name('search');
        Route::get('/', 'CartController@index')->name('index');
        Route::post('/add', 'CartController@add')->name('add');
        Route::put('/update', 'CartController@update')->name('update');
        Route::post('/remove', 'CartController@remove')->name('add');
    });

    Route::prefix('order')->name('order.')->group(function () {
        Route::get('/', 'OrderController@index')->name('index');
        Route::post('/get-data', 'OrderController@getData')->name('get-data');
        Route::post('/order', 'OrderController@order')->name('order');
        Route::get('/placed', 'OrderController@placed')->name('placed');
        Route::post('/placed-detail', 'OrderController@placedDetail')->name('order');
    });

<<<<<<< HEAD
    Route::prefix('admin')->name('admin.')->middleware(['can:check-is-admin'])->group(function () {
=======
    Route::prefix('admin')->name('admin.')->middleware('can:check-user-is-admin')->group(function () {
>>>>>>> 274f033c5d832f30f1d64839e2d7ee7b17e750bf
        Route::get('/', 'AdminController@index')->name('index');
        Route::get('/order-placed', 'OrderController@placed')->name('order-placed');
        Route::get('/products/', 'AdminController@product')->name('product.index');
        Route::post('products/search', 'AdminController@search')->name('product.search');
        Route::post('products/detail/{id}', 'AdminController@detail')->name('detail');
        Route::post('products/add', 'AdminController@add')->name('add');
        Route::post('products/store', 'AdminController@store')->name('store');
        Route::post('products/edit/{id}', 'AdminController@edit')->name('edit');
        Route::post('products/update/{id}', 'AdminController@update')->name('edit');
        Route::delete('products/delete', 'AdminController@delete')->name('delete');
    });
});





require __DIR__ . '/auth.php';
