<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\ResponseShape as FormRequest;
use Illuminate\Http\Request;

class NewsRequest extends FormRequest
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
            "field" => "required",
            "date" => "required",
            "title" => "required",
            "publication_date" => "required",
            "summary" => "required",
            "text" => "required",
            "keywords" => "required",
            "main_image" => "required",
            "side_image" => "required",
            "editor_name" => "required",
            "editing_date" => "required",
            "new_id" => "exists:news,id",
        ];

        return $validations;
    }
}
