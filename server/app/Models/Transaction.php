<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\VCard;
use App\Models\Categorie;

class Transaction extends Model
{
    use HasFactory;
    protected $table = 'transactions';


    protected $fillable = [
        //DATETIME?
        'vcard',
        'date',
        'type',
        'value',
        'old_balance',
        'new_balance',
        'payment_type',
        'payment_reference',
        'pair_transaction',
        'pair_vcard',
        'category_id',
        'description'
    ];

    public function vcard_owner()
    {
        return $this->belongsTo(VCard::class, 'vcard', 'phone_number');
    }
    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }
    

}
