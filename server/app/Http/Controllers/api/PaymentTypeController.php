<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PaymentTypeResource;
use App\Models\PaymentType;
use Illuminate\Http\Request;
use App\Http\Requests\PaymentTypeRequest;

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
}
