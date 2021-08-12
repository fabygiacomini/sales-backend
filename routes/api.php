<?php

use \App\Http\Controllers\SellerController;
use \App\Http\Controllers\SaleController;
use \App\Http\Controllers\MailController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/seller', [SellerController::class, 'getSellers']);

Route::delete('/seller/{id}', [SellerController::class, 'deleteSeller']);

Route::post('/seller', [SellerController::class, 'editCreateSeller']);

//----------------------

Route::get('/sales/{name?}', SaleController::class.'@getSales');

Route::post('/sales', [SaleController::class, 'insertSale']);

Route::get('/mail', [MailController::class, 'sendMail']); // para testar envios
