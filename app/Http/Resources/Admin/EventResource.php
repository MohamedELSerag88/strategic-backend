<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
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
            "category_id" => $this->category_id ,
            "specialization" => $this->specialization ,
            "objective" => $this->objective ,
            "main_axes" => $this->main_axes ,
            "main_knowledge" => $this->main_knowledge ,
            "main_skills" => $this->main_skills ,
            "presentation_format" => $this->presentation_format ,
            "duration" => $this->duration ,
            "duration_type" => $this->duration_type ,
            "price" => $this->price ,
            "content" => $this->content ,
            "expert_id" => $this->expert_id ,
            "event_id" => $this->event_id ,
            "consultation_id" => $this->consultation_id ,
        ];
    }
}
