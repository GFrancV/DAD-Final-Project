<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentTypeRequest;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\PaymentTypeResource;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Admin;
use App\Models\PaymentType;

class UserController extends Controller
{
    //
    public function index()
    {
        return UserResource::collection(User::paginate('10'));
    }

    public function indexAdmins(){
        $user = User::where('user_type', 'A')->paginate('10');
        return UserResource::collection($user);
    }

    public function createPaymenType(PaymentTypeRequest $request){
        $newPaymentType = PaymentType::create($request->validated());
        $newPaymentType->save();
        return new PaymentTypeResource($newPaymentType);

    }

    public function show(User $user)
    {
        return new UserResource($user);
    }
    public function show_me(Request $request)
    {
        return new UserResource($request->user());
    }
    public function update(UpdateUserRequest $request, User $user)
    {

        $user = Admin::where('id', $user->id)->first();
        $user->update($request->validated());
        $user->save();
        return new UserResource($user);
    }

    public function destroy(User $user)
    {
        Admin::where('id', $user->id)->delete();
        return new UserResource($user);
    }

}
