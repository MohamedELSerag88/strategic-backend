<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\ResponseShape as FormRequest;
use Illuminate\Http\Request;

class ConsultationRequest extends FormRequest
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
            "scope_of_work" => "required",
            "goal" => "required",
            "summary" => "required",
            "stages" => "required",
            "duration" => "required",
            "consultations_id" => "",
            "course_id" => "",
        ];

        return $validations;
    }
}
