<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Models\Admin;

class UserController extends Controller
{
    //
    public function index()
    {
        return UserResource::collection(User::paginate('10'));
    }

    public function indexAdmins(){
        $user = User::where('user_type', 'A')->get();
        return UserResource::collection($user);
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
