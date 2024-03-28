<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupDepartment extends Model
{
    use HasFactory;
    protected $table = 'group_departments';
    protected $guarded = ['id'];

    public function scopeSearch($query, $term)
    {
        $query->whereHas('Department', function ($query) use ($term) {
            $query->where('name', 'like', '%' . $term . '%');
        });
    }
    public function scopeGroup($query, $term)
    {
        $query->whereHas('Group', function ($query) use ($term) {
            $query->where('name', 'like', '%' . $term . '%');
        });
    }
    public function Department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
    public function Group()
    {
        return $this->belongsTo(DeptGroup::class, 'group_id');
    }
}
