<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentationIncident extends Model
{
    use HasFactory;
    protected $table ='documentation_incidents';
    protected $guarded = ['id'];

}
