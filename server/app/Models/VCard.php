<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Transaction;
use App\Models\Category;

class VCard extends Model
{
    use HasFactory;
    protected $table = 'vcards';
    protected $primaryKey = 'phone_number';
    public $timestamps = false;

    protected $fillable = [
        'phone_number',
        'name',
        'email',
        'photo_url',
        'password',
        'confirmation_code',
        'blocked',
        'balance',
        'max_debit'
    ];



    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'vcard', 'phone_number');
    }
    public function categories()
    {
        return $this->hasMany(Category::class, 'vcard', 'phone_number');
    }

}
