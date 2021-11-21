<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\VCard;
use App\Models\Transaction;

class Categorie extends Model
{
    use HasFactory;


    public function vcard_owner()
    {
        return $this->belongsTo(VCard::class, 'vcard', 'phone_number');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

}
