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
            $query->where('departemen_contractor', 'like', '%' . $term . '%');
        });
    }
    public function scopeSearchWgId($query, $term)
    {
        $query->where('companyLevel_id',$term);
    }
    public function CompanyLevel()
    {
        return $this->belongsTo(CompanyLevel::class, 'companyLevel_id');
    }
}
