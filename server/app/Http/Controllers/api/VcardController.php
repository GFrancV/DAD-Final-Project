<?php

namespace App\Http\Controllers\api;

use App\Models\VCard;
use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\VcardResource;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreUpdateVCardsRequest;

class VcardController extends Controller
{

    public function index()
    {
        $vcards = Vcard::all();
        return VcardResource::collection($vcards);
    }



    public function show(VCard $vcard)
    {
        return new VcardResource($vcard);
    }

    public function store(StoreUpdateVCardsRequest $request)
    {
        $newVcard = VCard::create($request->validated());
        $newVcard->save();
        return new VcardResource($newVcard);
    }

    public function update(Request $request, VCard $vcard)
    {
        $newCode = "";
        $newPassword = "";

        //Verificar confirmation_code atual
        if ($request->currentCode == "") {
            $newCode = $vcard->confirmation_code;
        } else {
            if (!Hash::check($request->currentCode, $vcard->confirmation_code)) {
                return "Wrong current confirmation_code";
            }
            //Hash confirmation_code
            $newCode = Hash::make($request->confirmation_code);
        }

        //Verificar password atual
        if ($request->newPassword == "") {
            $newPassword = $vcard->password;
        } else {
            if (!Hash::check($request->currentPassword, $vcard->password)) {
                return "Wrong current password";
            }
            //Hash password
            $newCode = Hash::make($request->password);
        }

        //Validar e atualizar dados restantes
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50|min:3',
            'email' => 'required|email',
            'photo_url' => 'nullable|string',
            'balance' => 'required|numeric|min:0',
            'max_debit' => 'required|numeric|min:0'
        ]);

        $vcard->update($validator->validated());

        $vcard->update(['password' => $newPassword, 'confirmation_code' => $newCode]);
        $vcard->save();
        return new VcardResource($vcard);
    }

    public function destroy(VCard $vcard)
    {
        Transaction::where("vcard", $vcard->phone_number)->delete();
        Category::where("vcard", $vcard->phone_number)->delete();
        $vcard = VCard::where('phone_number', $vcard->phone_number)->delete();
        return new VcardResource($vcard);
    }
}
