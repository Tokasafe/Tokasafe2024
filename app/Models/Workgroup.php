<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workgroup extends Model
{
    use HasFactory;
    protected $table = 'workgroups';
    protected $guarded = ['id'];

    public function scopeSearchWG($query, $term)
    {

        $query->whereHas('CompanyLevel', function ($query) use ($term) {
            $query->where('deptORcont', 'like', '%' . $term . '%');
        });
    }
    public function CompanyLevel()
    {
        return $this->belongsTo(CompanyLevel::class, 'companyLevel_id');
    }
}
