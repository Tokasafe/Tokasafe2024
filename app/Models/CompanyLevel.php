<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyLevel extends Model
{
    use HasFactory;
    protected $table = 'company_levels';
    protected $guarded = ['id'];

    public function scopeBussinesunit($query, $term)
    {

        $query->whereHas('BussinessUnit', function ($query) use ($term) {
            $query->where('name', 'like', '%' . $term . '%');
        });
    }
    public function scopeDeptcont($query, $term)
    {
        $query->where('deptORcont', 'like', '%' . $term . '%');
    }

    public function BussinessUnit()
    {
        return $this->belongsTo(Companies::class, 'bussiness_unit');
    }

}
