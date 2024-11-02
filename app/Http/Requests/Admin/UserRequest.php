<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\ResponseShape as FormRequest;
use Illuminate\Http\Request;

class UserRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        $validations =  [
            "name" => "required",
            "photo" =>"",
            "contact_type" =>"required|in:PHONE,EMAIL",
            "notification" => ""
        ];
        if (Request::isMethod('post')){
            $validations["email"] = "required|email|unique:users,email";
            $validations["password"] = "required";
        }
        elseif(Request::isMethod('put')){
            $url = explode('/',Request::url());
            $validations["email"] = "required|email|unique:users,email,".end($url);
        }
        return $validations;
    }
}
