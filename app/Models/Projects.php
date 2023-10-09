<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SebastianBergmann\Type\TrueType;

class Projects extends Model
{
    use HasFactory;
    protected $fillable = ['access_to_users'];

    protected $casts = [
        'access_to_users' => 'array',
    ];

    public function accessToUsers(){
        return $this->belongsToMany(Project_Access_Users::class, 'project__access__users');
    }

    public function users(){
        return $this->belongsToMany(User::class, 'project__access__users')->withPivot('role_id');
    }

    public function ownerName(){
        return $this->belongsTo(User::class, 'owner');
    }

    public function taskLists() {
        return $this->hasMany(TaskList::class, 'projects_id');
    }
    
}
