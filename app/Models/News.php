<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

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

    public function news(){
        return $this->belongsToMany(News::class,'news_related_news','news_id','related_id');
    }
}
