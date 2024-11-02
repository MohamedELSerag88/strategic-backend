<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\ResponseShape as FormRequest;
use Illuminate\Http\Request;

class AdminRequest extends FormRequest
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
            "status" => "required",
            "name" => "required",

            "role_id" => "required|exists:roles,id",
        ];
        if (Request::isMethod('post')){
            $validations["email"] = "required|email|unique:admins,email";
            $validations["password"] = "required";
        }
        elseif(Request::isMethod('put')){
            $url = explode('/',Request::url());
            $validations["email"] = "required|email|unique:admins,email,".end($url).",id";
        }
        return $validations;
    }
}
