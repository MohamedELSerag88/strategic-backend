<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'title',
        'specialization',
        'objective',
        'main_axes',
        'main_knowledge',
        'main_skills',
        'presentation_format',
        'duration',
        'duration_type',
        'price',
        'expert_id'
    ];

    public $search = ["name", "email"];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function eventDates(){
        return $this->hasOne(EventDate::class);
    }

    public function expert(){
        return $this->belongsTo(Expert::class);
    }

    public function events(){
        return $this->belongsToMany(Consultation::class,'event_related_events','event_id', 'related_id');
    }

    public function services()
    {
        return $this->hasMany(EventServices::class, 'event_id');
    }
}
