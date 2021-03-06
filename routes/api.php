<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CityController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\CityGroupController;
use App\Http\Controllers\LoginController;

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


Route::group(['prefix' => 'v1' ], function() {
  Route::post('/login', [ LoginController::class, 'login' ]);
  Route::post('/register', [ LoginController::class, 'register' ]);

  Route::middleware('auth:sanctum')->group(function(){
    Route::get('/user', [ LoginController::class, 'user' ]);
    Route::post('/logout', [ LoginController::class, 'logout' ]);

    Route::apiResource('products', ProductController::class );
    Route::apiResource('cities', CityController::class );
    Route::apiResource('campaigns', CampaignController::class );
    Route::apiResource('cityGroups', CityGroupController::class );
  });
});
