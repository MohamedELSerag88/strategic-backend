<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventServices extends Model
{
    use HasFactory;
    protected $table = 'event_serviceable';
    protected $fillable = [
        'serviceable_type',
        'serviceable_id',
        'event_id'
    ];

    public function serviceable()
    {
        return $this->morphTo();
    }
}
