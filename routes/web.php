<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Auth;
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
    return 'Trang chủ CLient';
})->name("index");



// LOGIN ADMIN
Route::group(["prefix"=>"admin", "as" => "admin.",'middleware' => 'checkLogoutAdmin'], function(){
    Route::get("/login",[AuthController::class,"index"])->name("login.get");

    Route::post("/login",[AuthController::class,"login"])->name("login.post");

});



// ADMIN
Route::group(["prefix" => "admin","as" => "admin.",'middleware' => 'checkAdmin'], function(){

    Route::get("/", function(){
        return view("admin/index");
    });

    // category
    Route::resource("categories",CategoryController::class);

    // product
    Route::resource("products",ProductController::class);

    // Đăng xuất
    Route::get("logout",[AuthController::class,"logout"])->name("logout");
 
});