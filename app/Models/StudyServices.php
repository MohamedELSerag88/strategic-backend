<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudyServices extends Model
{
    use HasFactory;
    protected $table = 'study_serviceable';
    protected $fillable = [
        'serviceable_type',
        'serviceable_id',
        'study_id'
    ];

    public function serviceable()
    {
        return $this->morphTo();
    }
}
