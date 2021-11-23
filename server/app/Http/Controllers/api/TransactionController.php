<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateTransactionRequest;
use Illuminate\Http\Request;
use App\Models\VCard;
use App\Models\Categorie;
use App\Http\Resources\TransactionResource;
use App\Models\Transaction;

class TransactionController extends Controller
{
    //

    public function getTransactionsOfVcard(Vcard $vcard)
    {
        return TransactionResource::collection($vcard->transactions);
    }

    public function getTransactionsOfCategories(Categorie $categorie)
    {
        return $categorie->transactions;
    }

    public function show(Transaction $transaction)
    {
        return new TransactionResource($transaction);
    }

    public function store(StoreUpdateTransactionRequest $request)
    {
        $newTransaction = Transaction::create($request->validated());
        return new TransactionResource($newTransaction);
    }

    public function update(StoreUpdateTransactionRequest $request, Transaction $transaction)
    {
        $transaction->update($request->validated());
        return new TransactionResource($transaction);
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->assignedUsers()->detach();
        $transaction->delete();
        return new TransactionResource($transaction);
    }


}
