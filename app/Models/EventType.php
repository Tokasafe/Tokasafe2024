<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventType extends Model
{
    use HasFactory;
    protected $table = 'event_types';
    protected $guarded = ['id'];
    public function scopeSearchtype($query, $term)
    {

        $query->where('name', 'like', '%' . $term . '%');

    }
    public function scopeSearchcategory($query, $term)
    {
        $query->whereHas('EventCategory', function ($query) use ($term) {
            $query->where('name', 'like', '%' . $term . '%');
        });
    }
    public function EventCategory()
    {
        return $this->belongsTo(EventCategory::class, 'eventCategory_id');
    }
    public function WorkflowTempalte()
    {
        return $this->belongsToMany(WorkflowTempalte::class, 'workflow_steps', 'workflow_template', 'eventTypeId');
    }

}
