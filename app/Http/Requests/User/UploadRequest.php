<?php

namespace App\Http\Requests\User;

use App\Http\Requests\ResponseShape as FormRequest;

class UploadRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
             'file' => 'required|max:25096',
        ];
    }
}
