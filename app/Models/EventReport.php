<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Vinkla\Hashids\Facades\Hashids;

class EventReport extends Model
{
    use HasFactory;
    protected $table = 'event_reports';
    protected $guarded = ['id'];
    protected $appends = ['eventid'];

    public function getEventidAttribute()
    {
        return Hashids::encode($this->attributes['id']);
    }

    public function setDateAttribute($value)
    {
        $this->attributes['tgl_kejadian'] = Carbon::createFromFormat('d-m-y', $value)->format('Y-m-d');
        $this->attributes['tgl_dilaporkan'] = Carbon::createFromFormat('d-m-y', $value)->format('Y-m-d');
    }

    public function EventType()
    {
        return $this->belongsTo(EventType::class, 'type_kejadian');
    }
    public function EventSubType()
    {
        return $this->belongsTo(EventSubType::class, 'jenis_kejadian');
    }
    public function Workgroup()
    {
        return $this->belongsTo(Workgroup::class, 'workgroup');
    }
    public function ActualOutcome()
    {
        return $this->belongsTo(RiskConsequence::class, 'actual_outcome');
    }
    public function PotentialConsequence()
    {
        return $this->belongsTo(RiskConsequence::class, 'potential_consequence');
    }
    public function PotentialLikelihood()
    {
        return $this->belongsTo(RiskLikelihood::class, 'potential_likelihood');
    }

}
