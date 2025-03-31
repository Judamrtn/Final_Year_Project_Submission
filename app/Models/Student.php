<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;

class Student extends Model
{
    use HasFactory;

    // Set the table name if it differs from the default (students)
    protected $table = 'students';

    // Enable timestamps if you want to store created_at and updated_at
    public $timestamps = true;

    // Define fillable attributes for mass assignment
    protected $fillable = [
        'StudentRegNumber',
        'StudentFirstName',
        'StudentLastName',
        'StudentGender',
        'StudentEmail',
        'StudentPhoneNumber',
        'password', // Make sure to hash passwords when storing
    ];

    // Specify the attributes to hide, like password
    protected $hidden = [
        'password',
    ];

    // Define the relationship between Student and Project
    public function project()
    {
        return $this->hasOne(Project::class, 'StudentRegNumber', 'StudentRegNumber');
    }
    public function supervisor()
    {
        return $this->belongsTo(Supervisor::class, 'SupervisorEmail');
    }
}
