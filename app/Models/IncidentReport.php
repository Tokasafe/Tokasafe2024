<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncidentReport extends Model
{
    use HasFactory;
    protected $table='incident_reports';
    protected $guarded =['id'];

    public function eventType()
    {
        return $this->belongsTo(EventType::class, 'event_type');
    }
    public function eventSubType()
    {
        return $this->belongsTo(EventSubType::class, 'sub_type');
    }
    public function workgroup()
    {
        return $this->belongsTo(Workgroup::class, 'workgroup_id');
    }
    public function repportBy()
    {
        return $this->belongsTo(People::class, 'reporter_name_id');
    }
    public function repportTo()
    {
        return $this->belongsTo(People::class, 'report_to_id');
    }
}
