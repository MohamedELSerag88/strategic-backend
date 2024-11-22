<?php

namespace App\Models;

use Database\Factories\StudyFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Study extends Model
{
    use HasFactory, SoftDeletes;

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

    protected static function newFactory()
    {
        return StudyFactory::new();
    }
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
