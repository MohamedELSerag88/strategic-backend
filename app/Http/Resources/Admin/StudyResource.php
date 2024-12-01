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
            "title" => $this->title ,
            "type" => $this->type ,
            "expert_id" => $this->expert_id ,
            "specialization" => $this->specialization ,
            "page_numbers" => $this->page_numbers ,
            "publication_date" => $this->publication_date ,
            "main_topics" => $this->main_topics ,
            "summary" => $this->summary ,
            "file" => $this->file ,
            "status" => $this->status ,
            "expert" => new ExpertResource($this->expert),
            "study_ids" => $this->studies->pluck("id")->toArray(),
            "related_studies" =>$this->studies->map(function($study){
                return [
                    "id" => $study->id,
                    "name" => $study->title,
                ];
            }),
            "related_services" =>$this->services->map(function($service){
                if(str_contains($service->serviceable_type,"Event")){
                    $name =$service->serviceable->category->name .' - '.$service->serviceable->title;
                }
                else{
                    $name = $service->serviceable->name ?? $service->serviceable->title;
                }
                return [
                    "id" => $service->serviceable_id,
                    "name" => $name,
                    "type" => $service->serviceable_type
                ];
            })
        ];
    }
}
