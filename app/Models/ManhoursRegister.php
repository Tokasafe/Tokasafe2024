<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManhoursRegister extends Model
{
    use \Staudenmeir\EloquentParamLimitFix\ParamLimitFix;
    use HasFactory;
    protected $table = 'manhours_registers';
    protected $guarded =['id'];

    public function scopeCompany($query,$term){
        $term = "%$term%";
        $query->where('company', 'like', $term );
    }
    public function scopeDept($query,$term){
        $term = "%$term";
        $query->where('dept', 'like',  $term );
    }
    public function scopeDateRange($query, $term)
    {
            $query->whereBetween('date', [$term, $this->endDate]); 
    }
    public function scopeCompanyCategory($query,$term){
        $term = "%$term%";
        $query->where('company_category', 'like',  $term );
    }
}
