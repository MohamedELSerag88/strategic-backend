<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudyResource extends JsonResource
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
            "type" => $this->type ,
            "expert_id" => $this->expert_id ,
            "specialization" => $this->specialization ,
            "page_numbers" => $this->page_numbers ,
            "publication_date" => $this->publication_date ,
            "main_topics" => $this->main_topics ,
            "summary" => $this->summary ,
            "file" => $this->file ,
            "study_id" => $this->study_id ,
        ];
    }
}
