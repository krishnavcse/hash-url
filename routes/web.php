<?php

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
Route::get('/',function(){
    return view('login');
})->name('/');

Route::get('login',function(){
    return view('login');
})->name('login');

Route::get('dashboard',[App\Http\Controllers\HomeController::class,'dashboard'])->name('dashboard');

Route::get('users',[App\Http\Controllers\UserController::class,'index'])->name('users');
Route::delete('user/delete/{userId}',[App\Http\Controllers\UserController::class,'delete']);
Route::post('user/update',[App\Http\Controllers\UserController::class,'update'])->name('user/update');

Route::get('url/create',[App\Http\Controllers\HashedUrlController::class,'create'])->name('url/create');
Route::post('url/create-update',[App\Http\Controllers\HashedUrlController::class,'createOrUpdateUrl'])->name('url/create-update');
Route::delete('url/delete/{urlId}',[App\Http\Controllers\HashedUrlController::class,'delete']);
Route::get('url/{hashedURL}',[App\Http\Controllers\HashedUrlController::class,'redirectURL']);
Route::get('hashed-urls',[App\Http\Controllers\HashedUrlController::class,'index'])->name('hashed-urls');

Route::get('user/register',[App\Http\Controllers\LoginController::class,'register'])->name('user/register');
Route::post('user/request/save',[App\Http\Controllers\LoginController::class,'storeRegister'])->name('user/request/save');

Route::get('user/login/view/new',[App\Http\Controllers\LoginController::class,'viewLogin'])->name('user/login/view/new');
Route::post('user/login',[App\Http\Controllers\LoginController::class,'login'])->name('user/login');
Route::get('user/logout',[App\Http\Controllers\LoginController::class,'logout'])->name('user/logout');
