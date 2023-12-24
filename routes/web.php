<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});
/*A method used to create RESTful routes for a resource controller.
It generates seven different routes that correspond to the
CRUD (Create, Read, Update, Delete) operations commonly associated with a resource.*/
Route::resource('products',\App\Http\Controllers\ProductController::class);


/*references :
https://www.youtube.com/watch?v=0qKTjSRjXnE&list=PLJetLDY7yKup1wDDkQObuRIzCeXYtpNvN&index=10
*/

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
