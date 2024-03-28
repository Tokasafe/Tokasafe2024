<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PihakTerlibat extends Model
{
    use HasFactory;
    protected $table = 'pihak_terlibat';
    protected $guarded = ['id'];
}
