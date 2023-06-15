<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetails extends Model
{
    use HasFactory;

    protected $primaryKey = 'transaction_detail_id';

    protected $fillable = [
        'tf_id', 'ticket_category_id', 'amount_ticket', 'total_ticket'
    ];

    public function transaksi()
    {
        return $this->belongsTo(Transaction::class, 'tf_id');
    }

    public function ticketCategory()
    {
        return $this->belongsTo(TicketCategory::class, 'ticket_category_id');
    }
}
