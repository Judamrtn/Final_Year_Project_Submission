<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campus extends Model
{
    use HasFactory;

    // Set the primary key
    protected $primaryKey = 'CampusId';
    public $incrementing = false; // Since the primary key is a string
    protected $keyType = 'string';

    // Fields that can be mass-assigned
    protected $fillable = [
        'CampusId',
        'CampusName',
        'FacultyCode',
    ];

    // Relationship: A campus belongs to a faculty
    public function faculty()
    {
        return $this->belongsTo(Faculty::class, 'FacultyCode', 'FacultyCode');
    }
}