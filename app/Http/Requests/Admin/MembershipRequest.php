<?php

namespace App\Http\Requests\Admin;

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
            "user_id" => "required|exists:users,id",
            "type" => "required|in:individual,organization",
            "duration" => "required",
            "start_date" => "required",
            "end_date" => "required",
            "job" => "required",
            "nationality" => "required",
            "resident_country" => "required",
            "phone" => "required",
        ];

        return $validations;
    }
}
