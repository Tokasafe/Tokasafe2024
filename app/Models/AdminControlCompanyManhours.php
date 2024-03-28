<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminControlCompanyManhours extends Model
{
    use HasFactory;
    protected $table = 'admin_control_company_manhours';
    // protected $guarded = ['id'];
    protected $fillable = [
        'user_id',
        'companies_id',
    ];

   
}
