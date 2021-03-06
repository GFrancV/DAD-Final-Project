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
        return VcardResource::collection(Vcard::paginate('10'));
    }

    public function indexAll()
    {
        return VcardResource::collection(Vcard::all());
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
            if (!Hash::check($request->confirmation_code, $vcard->confirmation_code)) {
                abort(400, "ERROR: Wrong current confirmation_code");
            }
            //Hash confirmation_code
            $newCode = Hash::make($request->confirmation_code);
        }

        //Verificar password atual
        if ($request->newPassword == "") {
            $newPassword = $vcard->password;
        } else {
            if (!Hash::check($request->currentPassword, $vcard->password)) {
                abort(400, "Wrong current password");
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

        $vcard->update($validator->validated() + ['password' => $newPassword, 'confirmation_code' => $newCode]);
        $vcard->save();
        return new VcardResource($vcard);
    }

    public function updateAdmin(StoreUpdateVCardsRequest $request, VCard $vcard)
    {
        $vcard->update(["max_debit" => $request->max_debit, "blocked" => $request->blocked]);
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
