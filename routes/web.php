<?php

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function (){
    Route::post('toggleAccess/{user}', [UserController::class, 'toggleAccess'])->name('users.toggle-access');
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class)->only('index');

    Route::post('products/{product}/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::get('checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
    Route::get('checkout/cancel', [CheckoutController::class, 'cancel'])->name('checkout.cancel');

    Route::post('purchase/{purchase}/cancel', [PurchaseController::class, 'cancel'])->name('purchases.cancel');
});
