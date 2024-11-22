<?php

namespace App\Models;

use Database\Factories\MembershipFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Membership extends Model
{
    use HasFactory, SoftDeletes;

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

    protected static function newFactory()
    {
        return MembershipFactory::new();
    }

}
