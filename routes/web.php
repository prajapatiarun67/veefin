<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\product\CartController;
use App\Http\Controllers\product\ProductListController;
use Illuminate\Support\Facades\Route;

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
/* 
Route::get('/', function () {
    return view('welcome');
});
 */

Route::get('/login', [AuthController::class, 'showHoLoginForm'])->name('login');
Route::post('/login/authenticate', [AuthController::class, 'authenticate'])->name('login.authenticate');

Route::get('/', [ProductListController::class, 'index']);

Route::get('/register', [AuthController::class, 'create'])->name('register');
Route::post('/login/store', [AuthController::class, 'store'])->name('login.store');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/add-to-cart', [CartController::class, 'index'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'cart_update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'cart_remove'])->name('cart.remove');
Route::get('/cart-view', [CartController::class, 'cart_view'])->name('cart.view');
Route::post('/order', [CartController::class, 'order'])->name('cart.order');

Route::get('/product', [ProductListController::class, 'index'])->name('product');
Route::middleware('logged_user')->group(function () {
    Route::get('/product/list', [ProductListController::class, 'list'])->name('product.list');
    Route::get('/product/create', [ProductListController::class, 'create'])->name('product.create');
    Route::post('/product/store', [ProductListController::class, 'store'])->name('product.store');
    Route::get('/product/edit/{product}', [ProductListController::class, 'edit'])->name('product.edit');
    Route::post('/product/update/{product}', [ProductListController::class, 'update'])->name('product.update');
    Route::get('/product/delete/{product}', [ProductListController::class, 'destroy'])->name('product.delete');
});
