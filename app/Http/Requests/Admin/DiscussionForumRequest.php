<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\ResponseShape as FormRequest;
use Illuminate\Http\Request;

class DiscussionForumRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $validations =  [
            "title" => "required",
            "subject" => "required",
            "domain" => "required",
            "start_date" => "required",
            "end_date" => "required",
            "forum_ids" => "array",
            "forum_ids.*" => "exists:discussion_forums,id",
            "serviceable_data" => "array",
        ];

        return $validations;
    }
}
