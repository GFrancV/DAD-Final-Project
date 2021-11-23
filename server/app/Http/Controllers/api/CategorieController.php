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

    public function show(Categorie $categorie)
    {
        return new CategorieResource($categorie);
    }

    public function store(StoreCategoriesRequest $request)
    {
        $newCategorie = Categorie::create($request->validated());
        return new CategorieResource($newCategorie);
    }

    public function update(StoreCategoriesRequest $request, Categorie $categorie)
    {
        $categorie->update($request->validated());
        return new CategorieResource($categorie);
    }

    public function destroy(Categorie $categorie)
    {
        Categorie::where("category_id", $categorie->id)->delete();
        return new CategorieResource($categorie);
    }

}
