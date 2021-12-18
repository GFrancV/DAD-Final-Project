<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PaymentTypeResource;
use App\Models\PaymentType;
use Illuminate\Http\Request;
use App\Http\Requests\PaymentTypeRequest;
use App\Models\Transaction;

class PaymentTypeController extends Controller
{
    //
    public function index()
    {
        $paymentType = PaymentType::all();
        return PaymentTypeResource::collection($paymentType);
    }


    public function createPaymentType(PaymentTypeRequest $request){
        $newPaymentType = PaymentType::create($request->validated());
        $newPaymentType->save();
        return new PaymentTypeResource($newPaymentType);
    }

    public function balanceAllPaymentTypes(Request $request,PaymentType $paymentType){
        if($request->type == 'C'){
            $transactions = Transaction::where('payment_type', $paymentType->code)->where('type','C')->get();
            $sum = $transactions->sum(function($transaction){
                return $transaction->value;
            });
        }else{
            $transactions = Transaction::where('payment_type', $paymentType->code)->where('type','D')->get();
            $sum = $transactions->sum(function($transaction){
                return $transaction->value;
            });
        }
        return $sum;
    }
}
