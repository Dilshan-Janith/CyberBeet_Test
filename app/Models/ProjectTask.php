<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectTask extends Model
{
    use HasFactory;

    protected $table = 'project_task';

    public function task(){
        return $this->belongsTo(Task::class);
    }

    public function project() {
        return $this->belongsTo(Project::class);
    }
}
