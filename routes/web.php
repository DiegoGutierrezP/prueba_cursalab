<?php

use App\Http\Controllers\api\AuthController;
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

Route::get('/login', function () {
    if(auth()->user()){
        return redirect()->route('home');
    }else{
        return view('auth.login');
    }
})->name('login');

Route::get('/register', function () {

    if(auth()->user()){
        return redirect()->route('home');
    }else{
        return view('auth.register');
    }
})->name('register');

Route::group(['middleware'=> ['auth:sanctum']],function(){
    Route::get('/',function(){
        return view('home');
    })->name('home');
    Route::get('logout',[AuthController::class,'logout']);
});


