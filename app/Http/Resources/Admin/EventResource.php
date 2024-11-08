<?php

namespace App\Http\Resources\Admin;

use App\Models\Category;
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
            "title" => $this->title ,
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
            "month" => $this->eventDates?->month,
            "week_number"=> $this->eventDates?->week_number,
            "from_date" =>$this->eventDates?->from_date,
            "to_date" => $this->eventDates?->to_date,
            "expert_id" => $this->expert_id ,
            "category" => new CategoryResource($this->category),
            "expert" => new ExpertResource($this->expert),
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
