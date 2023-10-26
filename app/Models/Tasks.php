<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject',
        'file_name',
        'doer',
        'start_date',
        'due_date',
        'pro_id',
        'task_list_id', 
        'notes',
        'priority',
        'progress',
        'est_hours',
        'est_minutes',
        'status',// Added this line for the foreign key
    ];

    protected $nullable = [
        
      
       
    ];

    public function taskList()
    {
        return $this->belongsTo(TaskList::class, 'task_list_id');
    }
}
