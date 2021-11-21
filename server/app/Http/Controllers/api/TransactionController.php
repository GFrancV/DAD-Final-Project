<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VCard;
use App\Models\Categorie;
use App\Http\Resources\TransactionResource;

class TransactionController extends Controller
{
    //

    public function getTransactionsOfVcard(Vcard $vcard) 
    { 
        return TransactionResource::collection($vcard->transactions);
    }

    public function getTransactionsOfCategories(Categorie $categorie) 
    { 
        return $categorie->transactions; 
    }
}
