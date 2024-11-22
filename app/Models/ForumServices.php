<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumServices extends Model
{
    use HasFactory;
    protected $table = 'forum_serviceable';
    protected $fillable = [
        'serviceable_type',
        'serviceable_id',
        'discussion_forum_id'
    ];

    public function serviceable()
    {
        return $this->morphTo();
    }
}
