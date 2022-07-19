<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
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

Route::middleware("auth:sanctum")->get("/user", function (Request $request) {
    return $request->user();
});

Route::prefix("cart")->group(function () {
    #HEALTHCHECK
    Route::get("/healthcheck", static function () {
        return "OK";
    });

    #CART
    Route::prefix("/{customer_id}")->group(function () {
        #ITEMS
        Route::prefix("/items")->group(function () {
            Route::post("/", [CartController::class, "store"]);
            Route::get("/", [CartController::class, "show"]);
            Route::delete("/{item_id}", [CartController::class, "destroy"]);
        });

        #REGISTER INFO
        Route::prefix("/register")->group(function () {
            Route::patch("/shipment-address", [CustomerController::class, "updateShipmentAddress"]);
            Route::patch("/billing-address", [CustomerController::class, "updateBillingAddress"]);
            Route::patch("/payment-method", [CustomerController::class, "updatePaymentMethod"]);
        });

        #CHECKOUT
        Route::post("/checkout", [CheckoutController::class, "store"]);
    });

    #PRODUCT
    Route::get("/products/search/{term}", [ProductController::class, "index"]);
});
