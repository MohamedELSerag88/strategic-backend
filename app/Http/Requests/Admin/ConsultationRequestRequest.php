<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\ResponseShape as FormRequest;
use Illuminate\Http\Request;

class ConsultationRequestRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $validations =  [
            "user_id" => "required|exists:users,id",
            "status" => "required",
            "org_name" => "required",
            "establishment_date" => "required",
            "ownership_type" => "required",
            "means_type" => "required",
            "headquarter_country" => "required",
            "employees_number" => "required",
            "external_offices_number" => "required",
            "annual_budget" => "required",
            "suffers_area" => "required",
            "notes" => "",
        ];

        return $validations;
    }
}
