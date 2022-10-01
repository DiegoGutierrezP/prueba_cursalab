<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\Api\CursosController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); */

Route::group(['middleware'=> ['auth:sanctum']],function(){
    Route::get('/prueba',function(){
        return 'estas logueado';
    });
    Route::get('logout',[AuthController::class,'logout']);
    Route::get('cursos-user',[CursosController::class,'cursos_user']);
    Route::get('get_curso/{id_curso}',[CursosController::class,'get_curso']);
});

Route::post('register',[AuthController::class,'register'])->name('auth.register');
Route::post('login',[AuthController::class,'login'])->name('auth.login');
