<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $table = 'departments';
    protected $guarded = ['id'];

    public function scopeSearch($query, $term)
    {

        $query->where('name', 'LIKE', '%' . $term . '%');
    }

    public function Group()
    {
        return $this->belongsToMany(DeptGroup::class, 'group_departments');
    }
}
