<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\ResponseShape as FormRequest;
use Illuminate\Http\Request;

class EventRequest extends FormRequest
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
            "category_id" => "required|integer|exists:categories,id",
            "specialization" => "required",
            "objective" => "required",
            "main_axes" => "required",
            "main_knowledge" => "required",
            "main_skills" => "required",
            "presentation_format" => "required",
            "duration" => "required",
            "duration_type" => "required",
            "price" => "required",
            "content" => "required",
            "expert_id" => "required|integer|exists:users,id",
            "event_id" => "required|integer|exists:events,id",
            "consultation_id" => "required|integer|exists:consultations,id",
        ];

        return $validations;
    }
}
