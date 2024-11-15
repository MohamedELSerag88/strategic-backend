<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventRequest extends Model
{
    use HasFactory;
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
}
