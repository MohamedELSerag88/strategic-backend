<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\ResponseShape as FormRequest;
use Illuminate\Http\Request;

class StudyRequest extends FormRequest
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
            "type" => "required",
            "expert_id" => "required",
            "specialization" => "required",
            "page_numbers" => "required",
            "publication_date" => "required",
            "main_topics" => "required",
            "summary" => "required",
            "file" => "required",
            "study_id" => "required|exists:studies,id",
        ];

        return $validations;
    }
}
