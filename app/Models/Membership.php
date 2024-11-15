<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
       'duration',
        'job',
        'nationality',
        'resident_country',
        'email',
        'phone',
        'password',
       'contact_type',
        'organization_name',
        'photo',
    ];

}
