<?php

namespace App\Models;

use Database\Factories\ConsultationFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Consultation extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'scope_of_work',
        'goal',
        'summary',
        'stages',
        'duration'
    ];
    public $search = ["name","goal"];
    protected static function newFactory()
    {
        return ConsultationFactory::new();
    }

    public function consultations(){
        return $this->belongsToMany(Consultation::class,'consultation_related_consultations','consultation_id','related_id');
    }

    public function events(){
        return $this->belongsToMany(Consultation::class,'consultation_related_events','consultation_id','event_id');
    }


}
