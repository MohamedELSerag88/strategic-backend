<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expert extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'about',
        'specialization',
        'job',
        'practical_experiences',
        'training_courses',
        'academic_qualifications',
        'research',
        'user_id'
    ];
}
