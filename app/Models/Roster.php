<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roster extends Model
{
    use HasFactory;
    protected $table = 'rosters';
    protected $guarded = ['id'];

    public function scopeSearch($query, $term)
    {
        $query->where('name', 'like', '%' . $term . '%');
    }
}
