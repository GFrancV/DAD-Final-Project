<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\VCard;
use App\Models\Categorie;

class Transaction extends Model
{
    use HasFactory;

    public function vcard_owner()
    {
        return $this->belongsTo(VCard::class, 'vcard');
    }
    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }
    

}
