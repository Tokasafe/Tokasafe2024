<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PanelHazardId extends Model
{
    use HasFactory;
    protected $table = 'panel_hazard_ids';
    protected $guarded = ['id'];


    public function Hazard()
    {
        return $this->belongsTo(HazardId::class, 'hazard_id');
    }
    public function scopeDateRange($query, $term)
    {

        $query->whereHas('Hazard', function ($query) use ($term) {
            $query->whereBetween('tanggal_kejadian', [$term, $this->endDate]);
        });
    }
    public function scopeMonth($query, $term)
    {

        if ($term) {
            return  $query->whereHas('Hazard', function ($q) use ($term) {
                $q->where('tanggal_kejadian', 'like', '%' . date('Y-m', strtotime($term)) . '%');
            });
        }
    }
    public function scopeWorkgroup($query, $term)
    {

        if ($term) {
            return  $query->whereHas('Hazard', function ($q) use ($term) {
                $q->where('Workgroup', 'like', '%' . $term . '%');
            });
        }
    }
    public function scopeReference($query, $term)
    {

        if ($term) {
            return  $query->whereHas('Hazard', function ($q) use ($term) {
                $q->where('event_subtype', 'like', '%' . $term . '%');
            });
        }
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
