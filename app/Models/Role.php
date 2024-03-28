<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $table = 'roles';
    protected $guarded = ['id'];

    public function scopeRole($query, $term)
    {

        $query->where('name', 'like', '%' . $term . '%');

    }
    public function scopeRoleclass($query, $term)
    {
        $query->whereHas('RoleClass', function ($query) use ($term) {
            $query->where('name', 'like', '%' . $term . '%');
        });
    }

    public function RoleClass()
    {
        return $this->belongsTo(RoleClass::class, 'roleClass_id');
    }
}
