<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VCard extends Model
{
    use HasFactory;
    use SoftDeletes;
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
