<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskList extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'task_list_name',
        'template',
        'notes',
        'users',
        'pin_task_list',
        'time',
        'projects_id',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'projects_id');
    }
    public function tasks()
{
    return $this->hasMany(Tasks::class, 'task_list_id');
}

}
