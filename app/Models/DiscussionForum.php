<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscussionForum extends Model
{
    use HasFactory;

    protected $fillable = [
        "title",
        "subject",
        "domain",
        "participants",
        "start_date",
        "end_date",
        'discussion_forum_id'
    ];
}
