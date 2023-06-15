<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventTalent extends Model
{
    use HasFactory;

    protected $primaryKey = 'event_talent_id';

    protected $fillable = [
        'event_talent_name', 'event_talent_img', 'event_id'
    ];

    public function event()
    {
        return $this->belongsTo(Events::class, 'event_id');
    }
}
