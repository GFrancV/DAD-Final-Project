<?php

namespace App\Models;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentType extends Model
{
    use HasFactory;
    use SoftDeletes;

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
