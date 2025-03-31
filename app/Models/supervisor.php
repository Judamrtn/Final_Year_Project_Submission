<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supervisor extends Model
{
    use HasFactory;

    // Set the primary key
    protected $primaryKey = 'SupervisorEmail';
    public $incrementing = false; // Since the primary key is a string
    protected $keyType = 'string';

    // Fields that can be mass-assigned
    protected $fillable = [
        'SupervisorEmail',
        'SupervisorFirstName',
        'SupervisorLastName',
        'SupervisorPhoneNumber',
        'ProjectCode',
        'password', // Add this field
    ];

    // Hide sensitive fields
    protected $hidden = [
        'password', // Hide the password field
    ];

    // Relationship: A supervisor has many projects
    public function projects()
    {
        return $this->hasMany(Project::class, 'SupervisorEmail', 'SupervisorEmail');
    }
    public function students()
    {
        return $this->hasMany(Student::class, 'supervisor_id');
    }
}
