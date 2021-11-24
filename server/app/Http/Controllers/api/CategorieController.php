<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoriesRequest;
use Illuminate\Http\Request;
use App\Models\VCard;
use App\Http\Resources\CategorieResource;
use App\Models\Categorie;

class CategorieController extends Controller
{
    //
    public function getCategoriesOfVcard(Vcard $vcard)
    {
        return CategorieResource::collection($vcard->categories);
    }

    public function show(Categorie $categorie, Vcard $vcard)
    {
        $vcardProvider = Vcard::where('phone_number',$vcard)->first();
        $categorie = Categorie::where('vcard',$vcardProvider->phone_number)->first();
        return new CategorieResource($categorie);
    }

    public function store(StoreCategoriesRequest $request,Vcard $vcard)
    {
        $vcardProvider = Vcard::where('phone_number',$vcard)->first();
        $newCategorie = Categorie::create($request->validated());
        $newCategorie->vcard = $vcardProvider->phone_number;
        return new CategorieResource($newCategorie);
    }

    public function update(StoreCategoriesRequest $request,Vcard $vcard, Categorie $categorie)
    {
        $vcardProvider = Vcard::where('phone_number',$vcard)->first();
        $categorie = Categorie::where('vcard',$vcardProvider->phone_number)->first();
        $categorie->update($request->validated());
        return new CategorieResource($categorie);
    }

    public function destroy(Categorie $categorie)
    {
        Categorie::where("category_id", $categorie->id)->delete();
        return new CategorieResource($categorie);
    }

}
