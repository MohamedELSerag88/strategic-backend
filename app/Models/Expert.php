<?php

namespace App\Models;

use Database\Factories\ExpertFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Expert extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'about',
        'specialization',
        'job',
        'practical_experiences',
        'training_courses',
        'academic_qualifications',
        'research',
        'nationality',
        'resident_country',
        'phone',
        'email'
    ];

    protected static function newFactory()
    {
        return ExpertFactory::new();
    }

    public $search = ["name", "about", "specialization","job"];
}
