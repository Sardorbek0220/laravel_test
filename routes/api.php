<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\WorkerController;
use App\Http\Controllers\API\FrontController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::group(['prefix' => 'admin', 'middleware' => ['auth:sanctum', 'admin']], function(){
	Route::resource('company', CompanyController::class);
    Route::resource('worker', WorkerController::class);
    Route::get('/users', [AuthController::class, 'users']);

    // userni companyga biriktirish va ushbu user company sifatida ishlay olishini taminlaydi
    Route::post('/apply/{id?}', [AuthController::class, 'apply']);
    // ----------------------------------------------------------------------------------
	Route::post('/logout', [AuthController::class, 'logout']);
});

Route::group(['prefix' => 'company', 'middleware' => ['auth:sanctum', 'company']], function(){
	Route::get('/', [FrontController::class, 'index']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

