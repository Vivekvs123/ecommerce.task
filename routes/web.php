<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CMSController;
use App\http\Controllers\OrderController;


Route::get('/', function () {
    return view('welcome');
});
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');
Route::resource('users','UserController');
Route::resource('banners','BannerController');
Route::resource('categories','CategoryController');
Route::resource('products','ProductController');
Route::resource('configuration','ConfigurationController');
Route::resource('contactus','ContactusController');
Route::resource('coupons','CouponController');

Route::get('/cms',[CMSController::class,'AddCMS'])->name('AddCMS');
Route::post('/addcms',[CMSController::class,'PostAddCMS'])->name('PostAddCMS');
Route::get('/showcms',[CMSController::class,'DisplayCMS'])->name('showCMS');
Route::patch('/deletecms',[CMSController::class,'DeleteCMS'])->name('DeleteCMS');
Route::get('/editcms/{id}',[CMSController::class,'EditCMS'])->name('EditCMS');
Route::post('/updatecms',[CMSController::class,'PostEditCMS'])->name('UpdateCMS');
Route::get('/order',[OrderController::class,'Orders'])->name('Orders');
Route::get('/showorderdetails/{id}',[OrderController::class,'OrdersDetail'])->name('OrdersDetail');
