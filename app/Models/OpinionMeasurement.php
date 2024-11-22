<?php

namespace App\Models;

use Database\Factories\OpinionMeasurementFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class OpinionMeasurement extends Model
{
    use HasFactory, SoftDeletes;

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
    ];

    protected static function newFactory()
    {
        return OpinionMeasurementFactory::new();
    }

    public function expert(){
        return $this->belongsTo(Expert::class);
    }

    public function opinions(){
        return $this->belongsToMany(OpinionMeasurement::class,'opinion_related_opinions', 'opinion_measurement_id', 'related_id');
    }

    public function services()
    {
        return $this->hasMany(OpinionServices::class, 'measurement_id');
    }

}
