<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Transaction;

class PaymentType extends Model
{
    use HasFactory;


    protected $table = 'payment_type';
    protected $primaryKey = 'code';
    public $timestamps = false;

    protected $fillable = [
        //DATETIME?
        'code',
        'name',
        'description'
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class,'payment_type','code');
    }


}
