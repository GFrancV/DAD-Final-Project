<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\TransactionController;
use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\api\VcardController;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\UserController;

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

//login

Route::post('login', [AuthController::class, 'login']);

//Users

Route::middleware('auth:api')->group(function () {
    Route::get('users/me', [UserController::class, 'show_me']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('users', [UserController::class, 'index'])->middleware('can:view,user');


    Route::get('users', [UserController::class, 'index'])->middleware('can:view,user');
    Route::get('users/{user}', [UserController::class, 'show'])->middleware('can:view,user');
    Route::put('users/{user}', [UserController::class, 'update'])->middleware('can:update,user');
});

Route::get('users', [UserController::class, 'index']);


//Transactions
Route::get('vcards/{vcard}/transactions', [TransactionController::class, 'getTransactionsOfVcard']);
Route::get('vcards/{vcard}/transactions/{transaction}', [TransactionController::class, 'show']);
Route::post('vcards/{vcard}/transactions', [TransactionController::class, 'store']);
Route::put('vcards/{vcard}/transactions/{transaction}', [TransactionController::class, 'update']);
Route::delete('vcards/{vcard}/transactions/{transaction}', [TransactionController::class, 'destroy']);

//Categories
Route::get('vcards/{vcard}/categories', [CategoryController::class, 'getCategoriesOfVcard']);
Route::get('vcards/{vcard}/categories/{category}', [CategoryController::class, 'show']);
Route::post('vcards/{vcard}/categories', [CategoryController::class, 'store']);
Route::put('vcards/{vcard}/categories/{category}', [CategoryController::class, 'update']);
Route::delete('vcards/{vcard}/categories/{category}', [CategoryController::class, 'destroy']);

//Vcard
Route::get('vcards/{vcard}', [VcardController::class, 'show']);
Route::post('vcards', [VcardController::class, 'store']);
Route::delete('vcards/{vcard}', [VcardController::class, 'destroy']);
Route::put('vcards/{vcard}', [VcardController::class, 'update']);
