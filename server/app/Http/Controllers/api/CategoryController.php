<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoriesRequest;
use Illuminate\Http\Request;
use App\Models\VCard;
use App\Http\Resources\CategoryResource;
use App\Models\Category;

class CategoryController extends Controller
{
    //
    public function getCategoriesOfVcard(Vcard $vcard)
    {
        return CategoryResource::collection($vcard->categories);
    }

    public function show(Category $categorie, Vcard $vcard)
    {
        $vcardProvider = Vcard::where('phone_number',$vcard)->first();
        $categorie = Category::where('vcard',$vcardProvider->phone_number)->first();
        return new CategoryResource($categorie);
    }

    public function store(StoreCategoriesRequest $request,Vcard $vcard)
    {
        $vcardProvider = Vcard::where('phone_number',$vcard)->first();
        $newCategorie = Category::create($request->validated());
        $newCategorie->vcard = $vcardProvider->phone_number;
        return new CategoryResource($newCategorie);
    }

    public function update(StoreCategoriesRequest $request,Vcard $vcard, Category $categorie)
    {
        $vcardProvider = Vcard::where('phone_number',$vcard)->first();
        $categorie = Category::where('vcard',$vcardProvider->phone_number)->first();
        $categorie->update($request->validated());
        return new CategoryResource($categorie);
    }

    public function destroy(Vcard $vcard,Category $categorie)
    {
        $vcardProvider = Vcard::where('phone_number',$vcard)->first();
        Category::where("vcard", $vcardProvider->phone_number)->delete();
        return new CategoryResource($categorie);
    }

}
