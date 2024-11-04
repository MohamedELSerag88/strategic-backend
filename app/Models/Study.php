<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Study extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'expert_id',
        'specialization',
        'page_numbers',
        'publication_date',
        'main_topics',
        'summary',
        'file',
        'study_id'
    ];
}
