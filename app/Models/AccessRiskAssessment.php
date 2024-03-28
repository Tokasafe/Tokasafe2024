<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessRiskAssessment extends Model
{
    use HasFactory;
    protected $table = 'access_risk_assessments';
    protected $guarded = ['id'];

    public function EventType()
    {
        return $this->belongsTo(EventType::class, 'event_type_id');
    }
}
