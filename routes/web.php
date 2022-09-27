<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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
    return redirect(route('login'));
})->name('welcome');

Auth::routes(['verify' => true]);

Route::get('/redirect-to-registration', function() {
   Cookie::queue(Cookie::forget(Str::slug(env('APP_NAME', 'laravel'), '_').'_session'));
   return redirect(route('register'));
})->name('redirect.register');

Route::middleware(['auth','verified'])->group(function () {
    Route::middleware(['admin'])->group(function () {
        Route::get('/admin-home', [HomeController::class, 'admin_index'])->name('admin.home');
    });
    Route::middleware(['user'])->group(function () {
        Route::get('/user-home', [HomeController::class, 'user_index'])->name('user.home');
    });
    Route::middleware(['pro'])->group(function () {
        Route::get('/pro-home', [HomeController::class, 'pro_index'])->name('pro.home');
    });
});
