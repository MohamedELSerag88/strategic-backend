<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExpertResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id ,
            "name" => $this->name ,
            "about" => $this->about ,
            "specialization" => $this->specialization ,
            "job" => $this->job ,
            "practical_experiences" => $this->practical_experiences ,
            "academic_qualifications" => $this->academic_qualifications ,
            "training_courses" => $this->training_courses ,
            "research" => $this->research ,
            "nationality" => $this->nationality ,
            "resident_country" => $this->resident_country ,
            "phone" =>$this->phone ,
            "email" =>$this->email
        ];
    }
}
