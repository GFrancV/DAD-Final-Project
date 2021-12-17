<?php

namespace App\Http\Controllers\api;

use App\Models\VCard;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\TransactionResource;
use App\Http\Requests\StoreUpdateTransactionRequest;

class TransactionController extends Controller
{
    //

    public function getTransactionsOfVcard(Vcard $vcard)
    {
        $vcardPaginate = Transaction::where('vcard', $vcard->phone_number)->orderBy('datetime', 'desc')->paginate(10);
        return TransactionResource::collection($vcardPaginate);
    }

    public function show(Vcard $vcard, Transaction $transaction)
    {
        $transaction = Transaction::where('vcard', $vcard->phone_number)->where('id', $transaction->id)->first();
        return new TransactionResource($transaction);
    }

    public function store(Request $request, Vcard $vcard)
    {
        //Validar e atualizar dados restantes
        $validator = Validator::make($request->all(), [
            'vcard' => 'required|exists:vcards,phone_number',
            'date' => 'nullable|date',
            'datetime' => 'required|date|date_format:Y-m-d H:i:s',
            'type' => 'required|in:C,D',
            'value' => 'required|numeric|min:0',
            'payment_type' => 'required|max:50|min:3',
            'payment_reference' => 'required|max:50|min:3',
            'pair_transaction' => 'nullable|exists:transactions,id',
            'pair_vcard' => 'nullable|exists:vcards,phone_number',
            'category_id' => 'nullable|exists:categories,id',
            'description' => 'nullable|max:50|min:3'
        ]);

        if (!Hash::check($request->confirmation_code, $vcard->confirmation_code)) {
            return "Wrong current confirmation_code";
        }
        $newBalance = 0;
        if ($request->type == "D") {
            $newBalance = $vcard->balance - $request->value;
        } else {
            $newBalance = $vcard->balance + $request->value;
        }

        $newTransaction = Transaction::create($validator->validated() + ["old_balance" => $vcard->balance, "new_balance" => $newBalance]);

        $newTransaction->old_balance = $vcard->balance;

        if ($newTransaction->pair_vcard == null) {
            $newTransaction->save();
            return new TransactionResource($newTransaction);
        }

        $newTransaction->vcard = $vcard->phone_number;

        $pair_vcard = Vcard::where('phone_number', $newTransaction->pair_vcard)->first();

        $pairTransaction = Transaction::create([
            'category_id' =>  $newTransaction->category_id,
            'category_name' => $newTransaction->name,
            'date' => $newTransaction->date,
            'datetime' => $newTransaction->datetime,
            'description' => $newTransaction->description,
            'old_balance' => $pair_vcard->balance,
            'new_balance' => $pair_vcard->balance + $newTransaction->value,
            'pair_transaction' => $newTransaction->id,
            'pair_vcard' => $newTransaction->vcard,
            'payment_reference' => $newTransaction->vcard,
            'payment_type' => $newTransaction->payment_type,
            'type' => "C",
            'value' => $newTransaction->value,
            'vcard' => $newTransaction->pair_vcard,
        ]);

        $newTransaction->pair_transaction = $pairTransaction->id;
        $pairTransaction->save();
        $newTransaction->save();
        return new TransactionResource($newTransaction);
    }

    public function update(StoreUpdateTransactionRequest $request, Vcard $vcard, Transaction $transaction)
    {
        $transaction = Transaction::where('vcard', $vcard->phone_number)->where('id', $transaction->id)->first();
        $transaction->update($request->validated());
        $transaction->save();
        return new TransactionResource($transaction);
    }

    public function destroy(Vcard $vcard, Transaction $transaction)
    {
        Transaction::where("vcard", $vcard->phone_number)->where('id', $transaction->id)->delete();
        return new TransactionResource($transaction);
    }
}
