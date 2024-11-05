<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;
    //$table->enum('scope_of_work',['Establish','Develop','Analysis','Measurement','Supervision','Other'])->default('Establish');
    protected $fillable = [
        'name',
        'scope_of_work',
        'goal',
        'summary',
        'stages',
        'duration'
    ];
    public $search = ["name","goal"];

    public function consultations(){
        return $this->belongsToMany(Consultation::class,'consultation_related_consultations','consultation_id','related_id');
    }

    public function events(){
        return $this->belongsToMany(Consultation::class,'consultation_related_events','consultation_id','event_id');
    }


}
