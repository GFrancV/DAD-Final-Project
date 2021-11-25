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
    public function getCategoriesOfVcard(Vcard $vcard)
    {
        return CategoryResource::collection($vcard->categories)->sortBy('name', SORT_STRING)->values()->all();
    }

    public function show(Category $category, Vcard $vcard)
    {
        $vcardProvider = Vcard::where('phone_number', $vcard->phone_number)->first();
        $category = Category::where('vcard', $vcardProvider->phone_number)->first();
        return new CategoryResource($category);
    }

    public function store(StoreCategoriesRequest $request, Vcard $vcard)
    {
        $vcardProvider = Vcard::where('phone_number', $vcard->phone_number)->first();
        $newCategory = Category::create($request->validated());
        $newCategory->vcard = $vcardProvider->phone_number;
        return new CategoryResource($newCategory);
    }

    public function update(StoreCategoriesRequest $request, Vcard $vcard, Category $category)
    {
        $vcardProvider = Vcard::where('phone_number', $vcard->phone_number)->first();
        $category = Category::where('vcard', $vcardProvider->phone_number)->first();
        $category->update($request->validated());
        return new CategoryResource($category);
    }

    public function destroy(Vcard $vcard, Category $category)
    {
        $vcardProvider = Vcard::where('phone_number', $vcard->phone_number)->first();
        Category::where("vcard", $vcardProvider->phone_number)->delete();
        return new CategoryResource($category);
    }
}
