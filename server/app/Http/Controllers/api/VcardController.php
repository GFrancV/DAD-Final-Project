<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateVCardsRequest;
use App\Http\Resources\VcardResource;
use App\Models\Categorie;
use App\Models\Transaction;
use App\Models\VCard;
use Illuminate\Http\Request;

class VcardController extends Controller
{
    //

    public function show(VCard $vcard)
    {
        return new VcardResource($vcard);
    }

    public function store(StoreUpdateVCardsRequest $request)
    {
        $newVcard = VCard::create($request->validated());
        return new VcardResource($newVcard);
    }

    public function update(StoreUpdateVCardsRequest $request, Vcard $vcard)
    {
        $vcard->update($request->validated());
        return new VcardResource($vcard);
    }

    public function destroy(VCard $vcard)
    {
        Transaction::where("vcard", $vcard->phone_number)->delete();
        Categorie::where("vcard", $vcard->phone_number)->delete();
        $vcard->delete();
        return new VcardResource($vcard);
    }
}
