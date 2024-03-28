<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkflowStep extends Model
{
    use HasFactory;

    protected $table = 'workflow_steps';
    protected $guarded = ['id'];

    public function EventType()
    {
        return $this->belongsTo(EventType::class, 'eventTypeId');
    }
    public function scopeSearch($query, $term)
    {
        $query->where('name', 'LIKE', '%' . $term . '%')->orwhere('description', 'LIKE', '%' . $term . '%');
    }

}
