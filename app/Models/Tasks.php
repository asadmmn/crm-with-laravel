<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject',
        'file-name',
        'doer',
        'start_date',
        'due_date',
        'notes',
        'priority',
        'progress',
        'est_hours',
        'est_minutes',
        'status',
        'task_list_id', // Added this line for the foreign key
    ];

    public function taskList()
    {
        return $this->belongsTo(TaskList::class, 'task_list_id');
    }
}
