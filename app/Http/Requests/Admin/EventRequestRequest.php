<?php

namespace App\Http\Requests\Admin;

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
            "status" => "required|in:pending,approved,rejected"
        ];

        return $validations;
    }
}
