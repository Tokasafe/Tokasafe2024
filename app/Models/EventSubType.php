<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventSubType extends Model
{
    use HasFactory;
    protected $table = 'event_sub_types';
    protected $guarded = ['id'];
    public function scopeSearcsubtype($query, $term)
    {

        $query->where('name', 'like', '%' . $term . '%');

    }
    public function scopeSearchtype($query, $term)
    {
        $query->whereHas('EventType', function ($query) use ($term) {
            $query->where('name', 'like', '%' . $term . '%');
        });
    }

    public function EventType()
    {
        return $this->belongsTo(EventType::class, 'eventType_id');
    }
    public function userSecurity()
    {
        return $this->belongsTo(UserSecurity::class);
    }
}
