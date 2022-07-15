<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CheckoutController;

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

Route::prefix('cart')->group(function () {
    #HEALTHCHECK
    Route::get('/healthcheck', function () {
        return 'OK';
    });

    #CHECKOUT
    Route::post('/checkout/{orderId}', [CheckoutController::class, 'store']);    

    #ORDERS
    Route::prefix('orders')->group(function(){
        Route::delete('/{orderId}/{productId}', [OrderController::class, 'delete']);        
        Route::get('/{orderId}', [OrderController::class, 'show']);      
        Route::post('/store', [OrderController::class, 'store']);
        Route::put('/{orderId}', [OrderController::class, 'update']); 
    });     

});


