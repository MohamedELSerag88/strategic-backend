<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\ResponseShape as FormRequest;
use Illuminate\Http\Request;

class PageRequest extends FormRequest
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
            "content" => "required"
        ];

        return $validations;
    }
}
