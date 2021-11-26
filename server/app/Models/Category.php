<?php

namespace App\Models;

use App\Models\VCard;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'categories';
    public $timestamps = false;

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
