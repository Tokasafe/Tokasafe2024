<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventLocation extends Model
{
    use HasFactory;
    protected $table = 'event_locations';
    protected $guarded = ['id'];
    public function scopeSearch($query, $term)
    {

        $query->where('name', 'LIKE', '%' . $term . '%');
    }
}
