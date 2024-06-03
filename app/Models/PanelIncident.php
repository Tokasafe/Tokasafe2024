<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PanelIncident extends Model
{
    use HasFactory;
    protected $table='panel_incidents';
    protected $guarded = ['id'];
    public function scopeDateRange($query, $term)
    {

        $query->whereHas('Incident', function ($query) use ($term) {
            $query->whereBetween('date_event', [$term, $this->endDate]);
        });
    }
    public function scopeSearchEventType($query, $term)
    {

        if ($term) {
            return  $query->whereHas('Incident', function ($q) use ($term) {
                $q->where('event_type', 'like', '%' . $term . '%');
            });
        }
       
    }
    public function scopeSearchSubEventType($query, $term)
    {
        if ($term) {
            return  $query->whereHas('Incident', function ($q) use ($term) {
                $q->where('sub_type', 'like', '%' . $term . '%');
            });
        }
       
    }
    public function scopeSearchMonth($query, $term)
    {

        if ($term) {
            return  $query->whereHas('Incident', function ($q) use ($term) {
                $q->where('date_event', 'like', '%' . date('Y-m', strtotime($term)) . '%');
            });
        }
    }
    public function scopeSearchWorkgroup($query, $term)
    {

        if ($term) {
            return  $query->whereHas('Incident', function ($q) use ($term) {
                $q->where('workgroup_id', 'like', '%' . $term . '%');
            });
        }
    }
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
