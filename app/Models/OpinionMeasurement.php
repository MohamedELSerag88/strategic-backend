<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpinionMeasurement extends Model
{
    use HasFactory;

    protected $fillable = [
        "title",
        "subject",
        "domain",
        "targeted_segment",
        "geographical_scope",
        "participants",
        "start_date",
        "end_date",
        'expert_id',
        'opinion_measurement_id'
    ];

}
