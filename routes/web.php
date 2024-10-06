<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
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
});



// ADMIN
Route::group(["prefix" => "admin","as" => "admin."], function(){

    Route::get("/", function(){
        return view("admin/index");
    });

    // category
    Route::resource("categories",CategoryController::class);

    // product
    Route::resource("products",ProductController::class);
});