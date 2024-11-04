<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\ResponseShape as FormRequest;
use Illuminate\Http\Request;

class ExpertRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $validations =  [
            //
            "name" => "required",
            "about" => "required",
            "specialization" => "required",
            "job" => "required",
            "practical_experiences" => "required",
            "training_courses" => "required",
            "academic_qualifications" => "required",
            "research" => "required",
            "user_id" => "required|exists:users,id",
        ];

        return $validations;
    }
}
