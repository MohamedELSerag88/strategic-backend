<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\ResponseShape as FormRequest;
use Illuminate\Http\Request;

class OpinionMeasurementRequest extends FormRequest
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
            "title" => "required",
            "subject" => "required",
            "domain" => "required",
            "targeted_segment" => "required",
            "geographical_scope" => "required",
            "participants" => "required|array",
            "start_date" => "required",
            "end_date" => "required",
            "expert_id" => "required",
            "opinion_measurement_id" => "exists:opinion_measurements,id",
        ];

        return $validations;
    }
}
