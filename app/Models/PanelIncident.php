<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PanelIncident extends Model
{
    use HasFactory;
    protected $table='panel_incidents';
    protected $guarded = ['id'];
    public function Incident()
    {
        return $this->belongsTo(IncidentReport::class, 'incident_report_id');
    }
    public function WorkflowStep()
    {
        return $this->belongsTo(WorkflowAdministration::class, 'workflow_step');
    }
    public function AssignTo()
    {
        return $this->belongsTo(People::class, 'assignTo');
    }
    public function Also_assignTo()
    {
        return $this->belongsTo(People::class, 'also_assignTo');
    }
}
