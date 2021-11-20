<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Transaction;
use App\Models\Categorie;

class VCard extends Model
{
    use HasFactory;

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'vcard');
    }
    public function categories()
    {
        return $this->hasMany(Categorie::class, 'vcard');
    }

}
