<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkflowAdministration extends Model
{
    use HasFactory;
    protected $table = 'workflow_new';
    protected $guarded = ['id'];

    public function StatusCode()
    {
        return $this->belongsTo(StatusCode::class, 'status_code');
    }

    public function ResponsibleRole()
    {
        return $this->belongsTo(ResponsibleRole::class, 'responsible_role');
    }

}
