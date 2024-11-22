<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DiscussionForumResource extends JsonResource
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
            "subject" => $this->subject ,
            "domain" => $this->domain ,
            "start_date" => $this->start_date ,
            "end_date" => $this->end_date ,
            "related_forums" =>$this->forums->map(function($study){
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
