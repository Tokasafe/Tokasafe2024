<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    use HasFactory;
    protected $table = 'people';
    protected $guarded = ['id'];

    public function scopeSearch($query, $term)
    {

        $query->where('lookup_name', 'LIKE', '%' . $term . '%');
    }
    public function scopeSearchto($query, $term)
    {

        $query->where('lookup_name', 'LIKE', '%' . $term . '%');
    }

    public function Employer()
    {
        return $this->belongsTo(Companies::class, 'employer');
    }
}
