<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    use HasFactory, Sluggable;

    protected $primaryKey = 'event_id';

    protected $fillable = [
        'event_name', 'slug', 'date_held', 'event_description', 'location_held', 'event_status', 'event_poster', 'user_id'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'event_name',
                'onUpdate' => true,
            ]
        ];
    }

    public function ticketCategory()
    {
        return $this->hasMany(TicketCategory::class, 'event_id');
    }

    public function eventTalent()
    {
        return $this->hasMany(EventTalent::class, 'event_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function transaction()
    {
        return $this->hasMany(Transaction::class, 'event_id');
    }
}
