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

    public function getTransactionsOfVcard(VCard $vcard)
    {
        $vcardPaginate = Transaction::where('vcard', $vcard->phone_number)->orderBy('datetime', 'desc')->paginate(10);
        return TransactionResource::collection($vcardPaginate);
    }

    public function show(VCard $vcard, Transaction $transaction)
    {
        $transaction = Transaction::where('vcard', $vcard->phone_number)->where('id', $transaction->id)->first();
        return new TransactionResource($transaction);
    }

    private function updateBalance(VCard $vcard, $newBalance){
        $vcard->update(['balance' => $newBalance]);
        $vcard->save();
    }

    public function store(Request $request, VCard $vcard)
    {
        //Validar dados restantes
        $validator = Validator::make($request->all(), [
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

        //Verificar código de confimação
        if (!Hash::check($request->confirmation_code, $vcard->confirmation_code)) {
            abort(400, "ERROR: Wrong current confirmation_code");
        }

        //Calcular saldo antigo e novo saldo + verificação se há saldo suficiente
        $newBalance = 0;
        $isPairTransaction = $request->pair_vcard != null;

        //Se o tipo de pagamento for VCARD e não houver um pair_vcard, ou houver um pair_vcard e o tipo de pagamento não for VCARD, mostra erro
        if (($request->payment_type == "VCARD" && !$isPairTransaction) || ($isPairTransaction && $request->payment_type != "VCARD")) {
            abort(400, "ERROR: Payment type VCARD needs a pair vcard");
        }
        if ($request->vcard == $request->pair_vcard) {
            abort(400, "ERROR: Can't make a transaction to your own vcard");
        }

        //Se for uma transação de débito, verifica se tem saldo suficiente para efetuar a transação
        if ($request->type == "D") {
            $newBalance = $vcard->balance - $request->value;
            if ($newBalance < 0) {
                abort(400, "ERROR: Insufficient balance");
            }
        } else {
            //Calcular saldo novo
            $newBalance = $vcard->balance + $request->value;
        }

        $newTransaction = Transaction::create($validator->validated() +
            ["old_balance" => $vcard->balance, "new_balance" => $newBalance, "vcard" => $vcard->phone_number]);

        //Se não for uma transação par, atualiza o saldo do cartão e devolve a transação nova
        if (!$isPairTransaction) {
            $this->updateBalance($vcard, $newBalance);
            $newTransaction->save();
            return new TransactionResource($newTransaction);
        }

        $pair_vcard = VCard::where('phone_number', $newTransaction->pair_vcard)->first();

        $pairNewBalance = $pair_vcard->balance + $newTransaction->value;
        $pairTransaction = Transaction::create([
            'category_id' =>  $newTransaction->category_id,
            'category_name' => $newTransaction->name,
            'date' => $newTransaction->date,
            'datetime' => $newTransaction->datetime,
            'description' => $newTransaction->description,
            'old_balance' => $pair_vcard->balance,
            'new_balance' => $pairNewBalance,
            'pair_transaction' => $newTransaction->id,
            'pair_vcard' => $newTransaction->vcard,
            'payment_reference' => $newTransaction->vcard,
            'payment_type' => $newTransaction->payment_type,
            'type' => "C",
            'value' => $newTransaction->value,
            'vcard' => $newTransaction->pair_vcard,
        ]);

        //Atribuir id da nova transação à transação par
        $newTransaction->pair_transaction = $pairTransaction->id;

        //Atualizar saldos dos cartões
        $this->updateBalance($vcard, $newBalance);
        $this->updateBalance($pair_vcard, $pairNewBalance);

        $pairTransaction->save();
        $newTransaction->save();
        return new TransactionResource($newTransaction);
    }

    public function update(StoreUpdateTransactionRequest $request, VCard $vcard, Transaction $transaction)
    {
        $transaction = Transaction::where('vcard', $vcard->phone_number)->where('id', $transaction->id)->first();
        $transaction->update($request->validated());
        $transaction->save();
        return new TransactionResource($transaction);
    }

    public function destroy(VCard $vcard, Transaction $transaction)
    {
        Transaction::where("vcard", $vcard->phone_number)->where('id', $transaction->id)->delete();
        return new TransactionResource($transaction);
    }
}
