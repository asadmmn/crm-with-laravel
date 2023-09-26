<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    // use HasFactory;
    public function project_user(){
        return $this->belongsTo(User::class);
    }

    public function accessToUsers(){
        return $this->belongsToMany(Project_Access_Users::class);
    }

    public function projects(){
        return $this->belongsToMany(Projects::class, 'project__access__users')->withPivot('role_id');
    }

    public function projectWithUAUser(){
        return $this->belongsToMany(Projects::class, 'project__access__users');
    }
}
