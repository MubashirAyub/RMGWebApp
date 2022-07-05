<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\FirebaseController;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('user','fireauth');

// Route::get('/home/customer', [App\Http\Controllers\HomeController::class, 'customer'])->middleware('user','fireauth');

Route::get('/email/verify', [App\Http\Controllers\Auth\ResetController::class, 'verify_email'])->name('verify')->middleware('fireauth');

Route::post('login/{provider}/callback', 'Auth\LoginController@handleCallback');

Route::resource('/home/profile', App\Http\Controllers\Auth\ProfileController::class)->middleware('user','fireauth');

Route::resource('/password/reset', App\Http\Controllers\Auth\ResetController::class);

Route::resource('/img', App\Http\Controllers\ImageController::class)->middleware(['fireauth']);
//Route::delete('delete-img/{id}', [ImageController::class,'destroy'])->middleware(['fireauth']);



Route::group(['prefix' => '{locale}', 'middleware' => 'setLocale'], function () {
    Route::get('/admin_dashboard', [RegisterController::class,'accounts'])->middleware(['fireauth'],'setLocale');

});

//Routes for Admin

Route::get('add-user', [RegisterController::class,'create'])->middleware(['fireauth']); 
Route::post('add-user', [RegisterController::class,'store'])->middleware(['fireauth']);
Route::get('edit-user/{id}', [RegisterController::class,'edit'])->middleware(['fireauth']);
Route::put('update-user/{id}', [RegisterController::class,'update'])->middleware(['fireauth']);
Route::delete('delete-user/{id}', [RegisterController::class,'destroy'])->middleware(['fireauth']);


//Routes for Manager
Route::get('/manager_dashboard', [RegisterController::class,'managerAccounts'])->middleware(['fireauth']);
Route::get('new-user', [RegisterController::class,'createNew'])->middleware(['fireauth']);
Route::post('new-user', [RegisterController::class,'storeNew'])->middleware(['fireauth']);
Route::get('edit-newuser/{id}', [RegisterController::class,'editNew'])->middleware(['fireauth']);
Route::put('update-newuser/{id}', [RegisterController::class,'updateNew'])->middleware(['fireauth']);
Route::delete('delete-newuser/{id}', [RegisterController::class,'destroyNew'])->middleware(['fireauth']);


//Routes for Project
Route::get('/projectdetails', [ProjectController::class,'indexpro'])->middleware(['fireauth']);
Route::get('add-project', [ProjectController::class,'createpro'])->middleware(['fireauth']); 
Route::post('add-project', [ProjectController::class,'storepro'])->middleware(['fireauth']);
Route::get('edit-project/{id}', [ProjectController::class,'editpro'])->middleware(['fireauth']);
Route::put('update-project/{id}', [ProjectController::class,'updatepro'])->middleware(['fireauth']);
Route::delete('delete-project/{id}', [ProjectController::class,'destroypro'])->middleware(['fireauth']);

