<?php

namespace App\Models;

use App\Models\VCard;
use App\Models\Category;
use App\Models\Payment_type;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Transaction extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $timestamps = false;
    protected $table = 'transactions';

    protected $fillable = [
        'vcard',
        'date',
        'datetime',
        'type',
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
    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    public function payment_type()
    {
        return $this->belongsTo(Payment_type::class, 'payment_type', 'code');
    }
    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'pair_vcard');
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
