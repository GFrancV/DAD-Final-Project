<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VCard;
use App\Models\Categorie;

class TransactionController extends Controller
{
    //

    public function getTransactionsOfVcard(Vcard $vcard) 
    { 
        return $vcard->transactions; 
    }

    public function getTransactionsOfCategories(Categorie $categorie) 
    { 
        return $categorie->transactions; 
    }
}
