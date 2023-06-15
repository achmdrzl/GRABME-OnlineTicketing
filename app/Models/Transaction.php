<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model 
{
    use HasFactory;

    protected $primaryKey = 'tf_id';

    protected $fillable = [
        'status_payment', 'order_id', 'transaction_id', 'payment_type', 'internet_tax', 'total_payment', 'event_id', 'user_id', 'cetak'
    ];

    public function transaksiDetail()
    {
        return $this->hasMany(TransactionDetails::class, 'tf_id');
    }

    public function event()
    {
        return $this->belongsTo(Events::class, 'event_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
