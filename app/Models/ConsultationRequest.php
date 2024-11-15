<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsultationRequest extends Model
{
    use HasFactory;

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
}
