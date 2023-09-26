<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project_Access_Users extends Model
{
    use HasFactory;

    public function users(){
        return $this->belongsToMany(User::class, 'project__access__users')->withPivot('project_id');
    }

    public function projects(){
        return $this->belongsToMany(Projects::class, 'project__access__users')->withPivot('user_id');
    }
}
