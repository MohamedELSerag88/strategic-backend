<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpinionServices extends Model
{
    use HasFactory;
    protected $table = 'opinion_serviceable';
    protected $fillable = [
        'serviceable_type',
        'serviceable_id',
        'measurement_id'
    ];

    public function serviceable()
    {
        return $this->morphTo();
    }
}
