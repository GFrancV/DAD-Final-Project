<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\VCard;
use App\Models\Transaction;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'vcard',
        'type',
        'name'
    ];

    protected $fillable = [
        'vcard',
        'type',
        'name'
    ];


    public function vcard_owner()
    {
        return $this->belongsTo(VCard::class, 'vcard', 'phone_number');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function getTypeCategories()
    {
        switch ($this->type) {
            case 'C':
                return 'Credit';
            case 'D':
                return 'Debit';
        }
    }

}