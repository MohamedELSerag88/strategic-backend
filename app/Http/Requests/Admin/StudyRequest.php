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
            "title" => "required",
            "type" => "required",
            "specialization" => "required",
            "page_numbers" => "required",
            "publication_date" => "required",
            "main_topics" => "required",
            "summary" => "required",
            "file" => "required",
            "expert_id" => "required|exists:experts,id",
            "study_ids" => "array",
            "study_ids.*" => "exists:studies,id",
            "serviceable_data" => "array",
            "status" =>""
        ];

        return $validations;
    }
}
