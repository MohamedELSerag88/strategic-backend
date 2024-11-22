<?php

namespace App\Models;

use Database\Factories\NewsFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class News extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'field',
        'date',
        'title',
        'publication_date',
        'summary',
        'text',
        'keywords',
        'main_image',
        'side_image',
        'editor_name',
        'editing_date'
    ];

    protected static function newFactory()
    {
        return NewsFactory::new();
    }

    public function news(){
        return $this->belongsToMany(News::class,'news_related_news','news_id','related_id');
    }
}
