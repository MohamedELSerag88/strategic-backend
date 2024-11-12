<?php

namespace App\Http\Resources\User;

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
        $data =  [
            "id" => $this->id ,
            "name" => $this->name ,
            "scope_of_work" => $this->scope_of_work ,
            "goal" => $this->goal,
            "summary" => $this->summary,
            "stages" => $this->stages,
            "duration" => $this->duration,
        ];
        if($this->method == 'get'){
            $data['related_consultation'] = $this->consultations->transform(function($item, $key){
                return ["id" => $item->id ,
                        "name" => $item->name ,
                        "scope_of_work" => $item->scope_of_work ,
                        "goal" => $item->goal,
                        "summary" => $item->summary,
                        "stages" => $item->stages,
                        "duration" => $item->duration
                    ];
            });
            $data["events"] = EventResource::collection($this->events);
        }
        return $data;
    }
}
