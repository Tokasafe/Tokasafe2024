<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResponsibleRole extends Model
{
    use HasFactory;
    protected $table = 'responsible_roles';
    protected $guarded = ['id'];
}
