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
Route::get('transactions/{transaction}', [TransactionController::class, 'show']);
Route::post('transactions', [TransactionController::class, 'store']);
Route::delete('transactions/{transaction}', [TransactionController::class, 'destroy']);
Route::put('transactions/{transaction}', [TransactionController::class, 'update']);


//Cateogires
Route::get('vcards/{vcard}/categories', [CategoryController::class, 'getCategoriesOfVcard']);
Route::get('categories/{category}', [CategoryController::class, 'show']);
Route::post('categories', [CategoryController::class, 'store']);
Route::delete('categories/{category}', [CategoryController::class, 'destroy']);
Route::put('categories/{category}', [CategoryController::class, 'update']);

//Vcard
Route::get('vcards/{vcard}', [VcardController::class, 'show']);
Route::post('vcards', [VcardController::class, 'store']);
Route::delete('vcards/{vcard}', [VcardController::class, 'destroy']);
Route::put('vcards/{vcard}', [VcardController::class, 'update']);