<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Companies extends Model
{
    use HasFactory;
    protected $table = 'companies';
    // protected $guarded = ['id'];
    protected $fillable = [
        'name',
        'category_company',
    ];
    public function scopeSearchcategory($query, $term)
    {

        $query->whereHas('CompanyCategory', function ($query) use ($term) {
            $query->where('name', 'like', '%' . $term . '%');
        });
    }
    public function scopeSearchcompany($query, $term)
    {
        $term = "%$term%";
        $query->where('name', 'like', '%' . $term . '%');

    }

    public function CompanyCategory()
    {
        return $this->belongsTo(CompanyCategory::class, 'category_company');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'admin_control_company_manhours');
    }
}
