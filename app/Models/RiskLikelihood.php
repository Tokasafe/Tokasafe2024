<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiskLikelihood extends Model
{
    use HasFactory;
    protected $table = 'risk_likelihoods';
    protected $guarded = ['id'];
    public function scopeSearch($query, $term)
    {

        $query->where('name', 'LIKE', '%' . $term . '%');
    }
}
