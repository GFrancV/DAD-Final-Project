<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VCard;

class CategorieController extends Controller
{
    //
    public function getCategoriesOfVcard(Vcard $vcard) 
    { 
        return $vcard->categories; 
    }
}
