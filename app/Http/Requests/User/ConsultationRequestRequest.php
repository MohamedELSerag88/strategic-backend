<?php

namespace App\Http\Requests\User;

use App\Http\Requests\ResponseShape as FormRequest;

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
            "name" => "required",
            "job_position"=> "required",
            "email" => "required",
            "phone"=> "required",
            "org_type"=> "",
            "org_status"=> "required",
            "org_name"=> "required",
            "establishment_date"=> "required",
            "ownership_type"=> "required",
            "means_type"=> "required",
            "headquarter_country"=> "required",
            "employees_number"=> "required",
            "external_offices_number"=> "required",
            "annual_budget"=> "required",
            "suffers_area"=> "required",
            "notes"=> "",
        ];

        return $validations;
    }
}
