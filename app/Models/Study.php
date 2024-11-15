<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Study extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'title',
        'expert_id',
        'specialization',
        'page_numbers',
        'publication_date',
        'main_topics',
        'summary',
        'file'
    ];

    public function expert(){
        return $this->belongsTo(Expert::class);
    }

    public function studies(){
        return $this->belongsToMany(Study::class,'study_related_studies', 'study_id', 'related_id');
    }

    public function services()
    {
        return $this->hasMany(StudyServices::class, 'study_id');
    }
}
