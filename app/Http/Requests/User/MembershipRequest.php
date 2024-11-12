<?php

namespace App\Http\Requests\User;

use App\Http\Requests\ResponseShape as FormRequest;

class MembershipRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $validations =  [
            "type" => "required|in:individual,organization",
            "duration" => "required",
            "start_date" => "required",
            "end_date" => "required",
            "organization_name" => "",
            "nationality" => "required",
            "resident_country" => "required",
            "photo" => "",
        ];

        return $validations;
    }
}
