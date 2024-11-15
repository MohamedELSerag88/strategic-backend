<?php

namespace App\Http\Resources\User;

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
            "expert" => new ExpertResource($this->expert) ,
            "specialization" => $this->specialization ,
            "page_numbers" => $this->page_numbers ,
            "publication_date" => $this->publication_date ,
            "main_topics" => $this->main_topics ,
            "summary" => $this->summary ,
            "file" => $this->file ,
            "related_studies" => StudyResource::collection($this->studies),
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
