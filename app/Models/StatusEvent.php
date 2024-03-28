<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Vinkla\Hashids\Facades\Hashids;

class StatusEvent extends Model
{
    use HasFactory;
    protected $table = 'status_events';
    protected $guarded = ['id'];
    protected $appends = ['hashid'];
    public function getHashidAttribute()
    {
        return Hashids::encode($this->attributes['event_report_id']);
    }

    public function scopeSearchEventCategory($query, $term)
    {
        $query->whereHas('EventReport', function ($query) use ($term) {
            $query->whereHas('EventType', function ($query) use ($term) {
                $query->where('eventCategory_id', 'like', '%' . $term . '%');
            });
        });
    }
    public function scopeSearchEventType($query, $term)
    {
        $query->whereHas('EventReport', function ($query) use ($term) {
            $query->whereHas('EventType', function ($query) use ($term) {
                $query->where('id', 'like', '%' . $term . '%');
            });
        });
    }
    public function scopeSearchEventSubType($query, $term)
    {
        $query->whereHas('EventReport', function ($query) use ($term) {
            $query->whereHas('EventSubType', function ($query) use ($term) {
                $query->where('id', 'like', '%' . $term . '%');
            });
        });
    }

    public function scopeDateRange($query, $term)
    {

        $query->whereHas('EventReport', function ($query) use ($term) {
            $query->whereBetween('tgl_kejadian', [$term, $this->endDate]);
        });
    }

    public function EventReport()
    {
        return $this->belongsTo(EventReport::class, 'event_report_id');
    }
    public function EventStatus()
    {
        return $this->belongsTo(WorkflowAdministration::class, 'status_code');
    }
    public function EventStatus2()
    {
        return $this->belongsTo(WorkflowAdministration::class, 'event_status_id');
    }
    public function AssignTo()
    {
        return $this->belongsTo(UserSecurity::class, 'assignTo');
    }
    public function Also_assignTo()
    {
        return $this->belongsTo(UserSecurity::class, 'also_assignTo');
    }
}
