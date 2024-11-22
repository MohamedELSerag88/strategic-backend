<?php

namespace App\Models;

use Database\Factories\EventRequestFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class EventRequest extends Model
{
    use HasFactory, SoftDeletes;
    protected $table ="event_requests";
    protected $fillable = [
        'event_id',
        'event_type',
        'event_presentation',
        'name',
        'job',
        'org_type',
        'phone',
        'org_name',
        'headquarter_country',
        'event_country',
        'event_date',
        'notes'
    ];

    protected static function newFactory()
    {
        return EventRequestFactory::new();
    }

    public function event(){
        return $this->belongsTo(Event::class);
    }
}
