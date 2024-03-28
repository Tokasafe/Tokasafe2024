<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSecurity extends Model
{
    use HasFactory;
    protected $table = 'user_securities';
    protected $guarded = ['id'];

    public function scopeSearchperson($query, $term)
    {
        $query->whereHas('People', function ($query) use ($term) {
            $query->where('lookup_name', 'like', '%' . $term . '%');
        });
    }
    public function scopeWorkgroup($query, $term)
    {

        $query->where('workgroup_id', 'like', '%' . $term . '%');

    }
    public function scopeFlow($query, $term)
    {

        $query->where('workflow', 'like', '%' . $term . '%');

    }

    public function scopeSearchwokrgroup($query, $term)
    {
        $query->whereHas('Workgroup', function ($query) use ($term) {
            $query->whereHas('CompanyLevel', function ($query) use ($term) {
                $query->where('deptORcont', 'like', '%' . $term . '%');
                $query->where('deptORcont', 'like', '%' . $term . '%');
            });
        });
    }
    public function Workgroup()
    {
        return $this->belongsTo(Workgroup::class, 'workgroup_id');
    }
    public function People()
    {
        return $this->belongsTo(People::class, 'user_id');
    }
    public function eventsubtype()
    {
        return $this->belongsTo(eventsubtype::class,'event_sub_types_id');
    }
}
