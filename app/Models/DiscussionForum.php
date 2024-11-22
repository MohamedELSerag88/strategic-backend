<?php

namespace App\Models;

use Database\Factories\DiscussionForumFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class DiscussionForum extends Model
{
    use HasFactory, SoftDeletes;

    protected $table ="discussion_forums";

    protected $fillable = [
        "title",
        "subject",
        "domain",
        "participants",
        "start_date",
        "end_date"
    ];
    protected static function newFactory()
    {
        return DiscussionForumFactory::new();
    }
    public function forums(){
        return $this->belongsToMany(DiscussionForum::class,'discussion_forums_related', 'discussion_forum_id', 'related_id');
    }

    public function services()
    {
        return $this->hasMany(ForumServices::class, 'discussion_forum_id');
    }
}
