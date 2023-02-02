<?php

use App\Http\Controllers\API\V1\AuthController;
use App\Http\Controllers\API\V1\CategoriaController;
use App\Http\Controllers\API\V1\ServicioController as Servicio;
use App\Http\Controllers\API\V1\LugarController as Lugar;
use App\Http\Controllers\API\V1\ReservaController as Reserva;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [AuthController::class,'login']);
Route::post('registro', [AuthController::class,'registro']);
Route::get('home', [Lugar::class,'index']);
Route::get('home/{LugarId}',[Lugar::class,'show']);

//Route::group(['prefix'=>'v1'],
Route::group(['prefix'=>'user','middleware'=> ['auth:sanctum']],
function(){    
    //propiedades de usuarios
    Route::get('lugaruser', [Lugar::class, 'Lugaruser']);
    //reservas de usuarios
    Route::get('reservauser', [Reserva::class, 'Reservauser']);
    //lugares de categoría cabañas
    Route::get('cabanias', [Lugar::class, 'cabanias']);
    //lugares de categoría casas
    Route::get('casas', [Lugar::class, 'casas']);
    //lugares de categorias hotel
    Route::get('hotel', [Lugar::class, 'hotel']);

    //cerrar sesion
    Route::post('logout',[AuthController::class,'logout']);

    //Categorias
    Route::get('categorias',[CategoriaController::class,'index']);
    Route::post('categorias',[CategoriaController::class,'store']);
    Route::get('categorias/{CategoriaId}',[CategoriaController::class,'show']);
    Route::put('categorias/{CategoriaId}',[CategoriaController::class,'update']);
    Route::delete('categorias/{CategoriaId}',[CategoriaController::class,'destroy']);

    //Servicios
    Route::get('servicios',[Servicio::class,'index']);
    Route::post('servicios',[Servicio::class,'store']);
    Route::get('servicios/{ServicioId}',[Servicio::class,'show']);
    Route::put('servicios/{ServicioId}',[Servicio::class,'update']);
    Route::delete('servicios/{ServicioId}',[Servicio::class,'destroy']);

    Route::get('lugares',[Lugar::class,'index']);
    Route::post('lugares',[Lugar::class,'store']);
    Route::get('lugares/{LugarId}',[Lugar::class,'show']);
    Route::put('lugares/{LugarId}',[Lugar::class,'update']);
    Route::post('lugares/{LugarId}',[Lugar::class,'destroy']);

    Route::get('reservas',[Reserva::class,'index']);
    Route::post('reservas',[Reserva::class,'store']);
    Route::get('reservas/{ReservaId}',[Reserva::class,'show']);
    Route::put('reservas/{ReservaId}',[Reserva::class,'update']);
    Route::delete('reservas/{ReservaId}',[Reserva::class,'destroy']);

});