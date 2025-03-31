<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class department extends Model
{
    use HasFactory;

    // Set the primary key
    protected $primaryKey = 'DepartmentCode';
    public $incrementing = false; // Since the primary key is a string
    protected $keyType = 'string';

    // Fields that can be mass-assigned
    protected $fillable = [
        'DepartmentCode',
        'DepartmentName',
        'StudentRegNumber',
    ];

    // Relationship: A department belongs to a faculty
    public function faculty()
    {
        return $this->belongsTo(Faculty::class, 'DepartmentCode', 'DepartmentCode');
    }

    // Relationship: A department has many students
    public function students()
    {
        return $this->hasMany(Student::class, 'StudentRegNumber', 'StudentRegNumber');
    }

    // Relationship: A department has many projects
    public function projects()
    {
        return $this->hasMany(Project::class, 'DepartmentCode', 'DepartmentCode');
    }
}