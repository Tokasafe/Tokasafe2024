<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleClass extends Model
{
    use HasFactory;
    protected $table = 'role_classes';
    protected $guarded = ['id'];
    public function scopeSearch($query, $term)
    {
        $query->where('name', 'LIKE', '%' . $term . '%')->orwhere('description', 'LIKE', '%' . $term . '%');
    }
}
