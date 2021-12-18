<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileController;
use App\Http\Controllers\api\VcardController;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\api\PaymentTypeController;
use App\Http\Controllers\api\TransactionController;

//Login
Route::post('login', [AuthController::class, 'login']);

//Register cliente
Route::post('vcards', [VcardController::class, 'store']);

Route::middleware('auth:api')->group(function () {

    Route::post('logout', [AuthController::class, 'logout']);

    //Users
    Route::prefix('users')->group(function () {
        Route::get('me', [UserController::class, 'show_me']);
        Route::middleware('can:viewAny,App\Models\User')->group(function () {
            Route::get('/', [UserController::class, 'index']);
            Route::get('admins', [UserController::class, 'indexAdmins']);
        });
        Route::get('{user}', [UserController::class, 'show'])->middleware('can:view,user');
        Route::put('{user}', [UserController::class, 'update'])->middleware('can:update,user');
        Route::delete('{user}', [UserController::class, 'destroy'])->middleware('can:delete,user');
    });

    Route::prefix('vcards/{vcard}')->group(function () {
        //Transactions
        Route::prefix('transactions')->group(function () {
            Route::middleware('can:view,vcard,App\Models\VCard')->group(function () {
                Route::get('/', [TransactionController::class, 'getTransactionsOfVcard']);
                Route::get('{transaction}', [TransactionController::class, 'show']);
            });
            Route::post('/', [TransactionController::class, 'store'])->middleware('can:create,vcard,App\Models\VCard');
            Route::post('transactions/admin', [TransactionController::class, 'storeAdmin'])->middleware('can:createAdmin,App\Models\VCard');
            Route::put('{transaction}', [TransactionController::class, 'update'])->middleware('can:update,vcard,App\Models\VCard');
            Route::delete('{transaction}', [TransactionController::class, 'destroy'])->middleware('can:delete,vcard');
        });
        Route::get('AllTransactions', [TransactionController::class, 'getAllTransactions'])->middleware('can:view,vcard,App\Models\VCard');

        //Categories
        Route::prefix('categories')->group(function () {
            Route::middleware('can:view,vcard,App\Models\VCard')->group(function () {
                Route::get('/', [CategoryController::class, 'getCategoriesOfVcard']);
                Route::get('{category}', [CategoryController::class, 'show']);
            });

            Route::post('/', [CategoryController::class, 'store'])->middleware('can:update,vcard,App\Models\VCard');
            Route::put('{category}', [CategoryController::class, 'update'])->middleware('can:update,vcard,App\Models\VCard');
            Route::delete('{category}', [CategoryController::class, 'destroy'])->middleware('can:update,vcard,App\Models\VCard');
        });

        //Vcards
        Route::get('/', [VcardController::class, 'show'])->middleware('can:view,vcard');
        Route::middleware('can:update,vcard,App\Models\VCard')->group(function () {
            Route::patch('/', [VcardController::class, 'update']);
            Route::patch('/admin', [VcardController::class, 'updateAdmin']);
        });
        Route::delete('/', [VcardController::class, 'destroy'])->middleware('can:delete,vcard');
    });
    Route::middleware('can:viewAny,App\Models\User')->group(function () {
        Route::get('vcards', [VcardController::class, 'index']);
        Route::get('vcardsAll', [VcardController::class, 'indexAll']);
    });

    //Payment_types
    Route::prefix('paymentTypes')->group(function () {
        Route::get('', [PaymentTypeController::class, 'index']);

        Route::patch('{payment_type}', [PaymentTypeController::class, 'updateDescription'])->middleware('can:update,App\Models\User');
        Route::post('{payment_type}', [PaymentTypeController::class, 'store'])->middleware('can:create,App\Models\User');
        Route::delete('{payment_type}', [PaymentTypeController::class, 'destroy'])->middleware('can:delete,App\Models\User');
        Route::post('allBalance/{payment_type}', [PaymentTypeController::class, 'balanceAllPaymentTypes']);
    });

    //Files
    Route::post('/photo', [FileController::class, 'upload']);
});
