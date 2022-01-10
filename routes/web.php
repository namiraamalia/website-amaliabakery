<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ProductController;
use App\Http\Controllers\Front\CategoryController;
use App\Http\Controllers\Front\AboutUsController;
use App\Http\Controllers\Back\DashboardController;
use App\Http\Controllers\Back\WebProfileController;
use App\Http\Controllers\Back\AdminProfileController;
use App\Http\Controllers\Back\CategoryBackController;
use App\Http\Controllers\Back\ProductBackController;
use App\Http\Controllers\Back\AuthController;

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

Route::resource('/', HomeController::class);
Route::resource('product-category', CategoryController::class);
Route::get('products/{id}', [ProductController::class,'index'])->name('products.data');
Route::get('products/product-detail/{slug}', [ProductController::class,'show'])->name('products.show');
Route::resource('about-us', AboutController::class);

Route::resource('about-us', AboutUsController::class);
Route::resource('schedule', ScheduleController::class);
Route::resource('outer', OuterFrontController::class);
Route::resource('dashboard', DashboardController::class);
Route::resource('login', AuthController::class)->middleware('guest');

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    Route::resource('admin-profile', AdminProfileController::class);
    Route::post('admin-profile/check-username', [AdminProfileController::class, 'checkUsername'])->name('checkUsername');
    Route::post('admin-profile/check-email', [AdminProfileController::class, 'checkEmail'])->name('checkEmail');
    Route::resource('dashboard', DashboardController::class);
    Route::resource('web-profile', WebProfileController::class);
    Route::resource('categories', CategoryBackController::class);
    Route::resource('product-back', ProductBackController::class);
    Route::post('products/filter', [ProductBackController::class, 'filter'])->name('filter-bakery');
});

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});