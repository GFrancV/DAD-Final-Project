<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\VCard;
use App\Models\Categorie;
use App\Models\Payment_type;


class Transaction extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'transactions';

    protected $fillable = [
        'id',
        'vcard',
        'date',
        'datetime',
        'value',
        'old_balance',
        'new_balance',
        'payment_type',
        'payment_reference',
        'pair_transaction',
        'pair_vcard',
        'category_id',
        'description',
    ];

    public function vcard_owner()
    {
        return $this->belongsTo(VCard::class, 'vcard', 'phone_number');
    }
    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }


    public function payment_type()
    {
        return $this->belongsTo(Payment_type::class, 'payment_type', 'code');
    }

    /*
    public function getTypeAttribute()
    {
        switch ($this->type) {
            case 'C':
                return 'Credit Transaction';
            case 'D':
                return 'Debit Transaction';
        }
    }
    */
    

}
