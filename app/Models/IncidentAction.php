<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncidentAction extends Model
{
    use HasFactory;
    protected $table = 'incident_actions';
    protected $guarded = ['id'];
    public function People()
    {
        return $this->belongsTo(People::class, 'responsibility');
    }
    public function IncidentAction()
    {
        return $this->belongsTo(IncidentReport::class,'incident_report_id');
    }
}
