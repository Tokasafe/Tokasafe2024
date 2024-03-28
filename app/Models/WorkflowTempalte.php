<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkflowTempalte extends Model
{
    use HasFactory;
    protected $table = 'workflow_tempaltes';
    protected $guarded = ['id'];
    public function EventType()
    {
        return $this->belongsToMany(EventType::class, 'workflow_steps', 'workflow_template', 'eventTypeId');
    }
    // , 'workflow_template', 'eventTypeId'
}
