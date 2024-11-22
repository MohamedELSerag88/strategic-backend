<?php

namespace App\Models;

use Database\Factories\ConsultationRequestFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ConsultationRequest extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'job_position',
        'email',
        'phone',
        'org_type',
        'org_status',
        'org_name',
        'establishment_date',
        'ownership_type',
        'means_type',
        'headquarter_country',
        'employees_number',
        'external_offices_number',
        'annual_budget',
        'suffers_area',
        'notes'
    ];

    protected static function newFactory()
    {
        return ConsultationRequestFactory::new();
    }
}
