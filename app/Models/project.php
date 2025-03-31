<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    // Set the primary key
    protected $primaryKey = 'ProjectCode';
    public $incrementing = false; // Since the primary key is a string
    protected $keyType = 'string';

    // Fields that can be mass-assigned
    protected $fillable = [
        'ProjectCode',
        'ProjectName',
        'ProjectProblems',
        'ProjectSolutions',
        'ProjectAbstract',
        'DepartmentCode',
        'StudentRegNumber', 
        'ProjectDissertation',
        'ProjectSourceCodes',
        'Status',
        'SupervisorEmail', // Make sure this column exists in your 'projects' table
    ];

    // Define relationships
    public function student()
    {
        return $this->belongsTo(Student::class, 'StudentRegNumber', 'StudentRegNumber');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'DepartmentCode', 'DepartmentCode');
    }

    public function supervisor()
    {
        return $this->belongsTo(Supervisor::class, 'SupervisorEmail', 'SupervisorEmail');
    }

}
