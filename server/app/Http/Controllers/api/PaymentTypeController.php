<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PaymentTypeResource;
use App\Models\PaymentType;
use Illuminate\Http\Request;

class PaymentTypeController extends Controller
{
    //
    public function index()
    {
        $paymentType = PaymentType::all();
        return PaymentTypeResource::collection($paymentType);
    }

}
