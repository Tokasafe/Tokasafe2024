<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventAction extends Model
{
    use HasFactory;
    protected $table = 'event_actions';
    protected $guarded = ['id'];

    public function People()
    {
        return $this->belongsTo(People::class, 'responsibility');
    }
    public function HazardId()
    {
        return $this->belongsTo(HazardId::class,'hazard_id_id');
    }
}
