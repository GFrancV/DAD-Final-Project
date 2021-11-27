<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\TransactionController;
use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\api\VcardController;

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
