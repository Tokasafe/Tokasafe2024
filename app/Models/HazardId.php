<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HazardId extends Model
{
    use HasFactory;
    protected $table='hazard_ids';
    protected $guarded =['id'];

    public function EventSubType()
    {
        return $this->belongsTo(EventSubType::class, 'event_subtype');
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
    public function People()
    {
        return $this->belongsTo(People::class, 'nama_pelapor');
    }
    public function Pengawas()
    {
        return $this->belongsTo(People::class, 'pengawas_area');
    }
    public function EventAction()
    {
        return $this->hasMany(EventAction::class);
    }
}
