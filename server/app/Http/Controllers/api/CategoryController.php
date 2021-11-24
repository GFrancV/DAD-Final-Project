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

    public function show(Category $category)
    {
        return new CategoryResource($category);
    }

    public function store(StoreCategoriesRequest $request)
    {
        $newCategory = Category::create($request->validated());
        return new CategoryResource($newCategory);
    }

    public function update(StoreCategoriesRequest $request, Category $category)
    {
        $category->update($request->validated());
        return new CategoryResource($category);
    }

    public function destroy(Category $category)
    {
        Category::where("category_id", $category->id)->delete();
        return new CategoryResource($category);
    }

}
