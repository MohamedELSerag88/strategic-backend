<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ConsultationResource extends JsonResource
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
            "scope_of_work" => $this->scope_of_work ,
            "goal" => $this->goal,
            "summary" => $this->summary,
            "stages" => $this->stages,
            "duration" => $this->duration,
            "relatedConsultations_id" => $this->consultations->pluck("id")->toArray(),
            "course_id" => $this->course_id,
        ];
    }
}
