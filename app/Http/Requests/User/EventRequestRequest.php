<?php

namespace App\Http\Requests\User;

use App\Http\Requests\ResponseShape as FormRequest;

class EventRequestRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $validations =  [
            "event_id" => "required|exists:events,id",
            "event_type" => "required",
            "event_presentation" => "required",
            "name" => "required",
            "job" => "required",
            "org_type" => "required",
            "phone" => "required",
            "org_name" => "required",
            "headquarter_country" => "required",
            "event_country" => "required",
            "event_date" => "required",
            "notes" => "",
        ];

        return $validations;
    }
}
