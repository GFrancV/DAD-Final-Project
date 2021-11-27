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

    public function show(Vcard $vcard,Category $category)
    {
        $categorySend = Category::where('id',$category->id)->first();
        return new CategoryResource($category);
    }

    public function store(StoreCategoriesRequest $request, Vcard $vcard)
    {
        $newCategory = Category::create($request->validated());
        $newCategory->vcard = $vcard->phone_number;
        $newCategory->save();
        return new CategoryResource($newCategory);
    }

    public function update(StoreCategoriesRequest $request, Vcard $vcard, Category $category)
    {
        $category = Category::where('vcard', $vcard->phone_number)->first();
        $category->update($request->validated());
        $category->save();
        return new CategoryResource($category);
    }

    public function destroy(Vcard $vcard, Category $category)
    {
        Category::where("vcard", $vcard->phone_number)->delete();
        return new CategoryResource($category);
    }
}
