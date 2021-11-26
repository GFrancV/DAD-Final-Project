<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateTransactionRequest;
use Illuminate\Http\Request;
use App\Models\VCard;
use App\Models\Category;
use App\Http\Resources\TransactionResource;
use App\Models\Transaction;

class TransactionController extends Controller
{
    //

    public function getTransactionsOfVcard(Vcard $vcard)
    {
        return TransactionResource::collection($vcard->transactions);
    }

    public function show(Vcard $vcard, Transaction $transaction)
    {
        $transaction = Transaction::where('vcard', $vcard->phone_number)->first();
        return new TransactionResource($transaction);
    }

    public function store(StoreUpdateTransactionRequest $request, Vcard $vcard)
    {
        $newTransaction = Transaction::create($request->validated());
        $newTransaction->vcard = $vcard->phone_number;
        $newTransaction->save();
        return new TransactionResource($newTransaction);
    }

    public function update(StoreUpdateTransactionRequest $request, Vcard $vcard, Transaction $transaction)
    {
        $transaction = Transaction::where('vcard', $vcard->phone_number)->first();
        $transaction->update($request->validated());
        $transaction->save();
        return new TransactionResource($transaction);
    }

    public function destroy(Vcard $vcard, Transaction $transaction)
    {
        Transaction::where("vcard", $vcard->phone_number)->delete();
        return new TransactionResource($transaction);
    }
}
