<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'project_name',
        'task_id',
    ];

    public function task(){
        return $this->hasMany(Task::class, 'project_task');
    }
}
