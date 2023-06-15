<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketCategory extends Model
{
    use HasFactory;

    protected $primaryKey = 'ticket_category_id';

    protected $fillable = [
        'ticket_category_name', 'ticket_category_price', 'ticket_category_quota', 'ticket_category_status', 'event_id'
    ];

    public function event()
    {
        return $this->belongsTo(Events::class, 'event_id');
    }

    public function transactionDetail()
    {
        return $this->hasMany(TransactionDetails::class, 'ticket_category_id');
    }
}
