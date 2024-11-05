<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
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
}
