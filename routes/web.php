<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CountryController as C;
use App\Http\Controllers\HotelController as H;
use App\Http\Controllers\OrderController as O;
use App\Http\Controllers\FrontController as F;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('front')->name('front-')->group(function () {
    Route::get('/', [F::class, 'index'])->name('index');
    Route::get('/country/{country}', [F::class, 'countries'])->name('countries');
    Route::get('/hotel/{hotel}', [F::class, 'showHotel'])->name('show-hotel');
    Route::get('/my-orders', [F::class, 'orders'])->name('orders')->middleware('role:admin|client');
   
});

Route::prefix('countries')->name('countries-')->group(function () {
    Route::get('/', [C::class, 'index'])->name('index')->middleware('role:admin');
    Route::get('/create', [C::class, 'create'])->name('create')->middleware('role:admin');
    Route::post('/create', [C::class, 'store'])->name('store')->middleware('role:admin');
    Route::get('/edit/{cat}', [C::class, 'edit'])->name('edit')->middleware('role:admin');
    Route::put('/edit/{cat}', [C::class, 'update'])->name('update')->middleware('role:admin');
    Route::delete('/delete/{cat}', [C::class, 'destroy'])->name('delete')->middleware('role:admin');
});

Route::prefix('hotels')->name('hotels-')->group(function () {
    Route::get('/', [H::class, 'index'])->name('index')->middleware('role:admin|client');
    Route::get('/countries', [H::class, 'countries'])->name('countries')->middleware('role:admin');
    Route::get('/create', [H::class, 'create'])->name('create')->middleware('role:admin');
    Route::post('/create', [H::class, 'store'])->name('store')->middleware('role:admin');
    Route::get('/{hotel}', [H::class, 'show'])->name('show')->middleware('role:admin');
    Route::get('/edit/{hotel}', [H::class, 'edit'])->name('edit')->middleware('role:admin');
    Route::put('/edit/{hotel}', [H::class, 'update'])->name('update')->middleware('role:admin');
    Route::delete('/delete/{hotel}', [H::class, 'destroy'])->name('delete')->middleware('role:admin');
});

Route::prefix('orders')->name('orders-')->group(function () {
    Route::get('/', [O::class, 'index'])->name('index')->middleware('role:admin');
    Route::post('/order', [O::class, 'store'])->name('buy');
    Route::put('/status/{order}', [O::class, 'update'])->name('update')->middleware('role:admin');
    // Route::get('/create', [C::class, 'create'])->name('create')->middleware('role:admin');
    Route::post('/create', [C::class, 'store'])->name('store')->middleware('role:admin|client');
    // Route::get('/edit/{cat}', [C::class, 'edit'])->name('edit')->middleware('role:admin');
    Route::put('/edit/{order}', [C::class, 'update'])->name('update')->middleware('role:admin');
    Route::delete('/delete/{order}', [C::class, 'destroy'])->name('delete')->middleware('role:admin|client');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
