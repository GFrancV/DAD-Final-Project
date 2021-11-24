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



//Cateogires
Route::get('vcards/{vcard}/categories', [CategorieController::class, 'getCategoriesOfVcard']);
Route::get('vcards/{vcard}/category/{category}', [CategorieController::class, 'show']);
Route::post('vcards/{vcard}/categories', [CategorieController::class, 'store']);
Route::put('vcards/{vcard}/categories/{category}', [CategorieController::class, 'update']);
Route::delete('vcards/{vcard}/categories/{category}', [CategorieController::class, 'destroy']);
//Vcard
Route::get('vcards/{vcard}', [VcardController::class, 'show']);
Route::post('vcards', [VcardController::class, 'store']);
Route::delete('vcards/{vcard}', [VcardController::class, 'destroy']);
Route::put('vcards/{vcard}', [VcardController::class, 'update']);
