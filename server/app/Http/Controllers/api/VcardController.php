<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateVCardsRequest;
use App\Http\Resources\VcardResource;
use App\Models\Category;
use App\Models\Transaction;
use App\Models\VCard;
use Illuminate\Http\Request;

class VcardController extends Controller
{
    public function show(VCard $vcard)
    {
        $vcard = VCard::where('vcard', $vcard->phone_number)->first();
        return new VcardResource($vcard);
    }

    public function store(StoreUpdateVCardsRequest $request)
    {
        $newVcard = VCard::create($request->validated());
        $newVcard->save();
        return new VcardResource($newVcard);
    }

    public function update(StoreUpdateVCardsRequest $request, Vcard $vcard)
    {
        $vcard = VCard::where('vcard', $vcard->phone_number)->first();
        $vcard->update($request->validated());
        $vcard->save();
        return new VcardResource($vcard);
    }

    public function destroy(VCard $vcard)
    {
        Transaction::where("vcard", $vcard->phone_number)->delete();
        Category::where("vcard", $vcard->phone_number)->delete();
        $vcard = VCard::where('vcard', $vcard->phone_number)->delete();
        return new VcardResource($vcard);
    }
}
