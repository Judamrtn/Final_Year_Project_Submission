<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class faculty extends Model
{
    use HasFactory;

    // Set the primary key
    protected $primaryKey = 'FacultyCode';
    public $incrementing = false; // Since the primary key is a string
    protected $keyType = 'string';

    // Fields that can be mass-assigned
    protected $fillable = [
        'FacultyCode',
        'FacultyName',
        'DepartmentCode',
    ];

    // Relationship: A faculty has many departments
    public function departments()
    {
        return $this->hasMany(Department::class, 'DepartmentCode', 'DepartmentCode');
    }

    // Relationship: A faculty has many campuses
    public function campuses()
    {
        return $this->hasMany(Campus::class, 'FacultyCode', 'FacultyCode');
    }
}