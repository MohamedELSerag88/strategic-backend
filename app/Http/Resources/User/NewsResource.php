<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NewsResource extends JsonResource
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
            "field" => $this->field ,
            "date" => $this->date ,
            "title" => $this->title ,
            "publication_date" => $this->publication_date ,
            "summary" => $this->summary ,
            "text" => $this->text ,
            "keywords" => $this->keywords ,
            "main_image" => $this->main_image ,
            "side_image" => $this->side_image ,
            "editor_name" => $this->editor_name ,
            "editing_date" => $this->editing_date ,
            "relatedNews" => NewsResource::collection($this->news),
        ];
    }
}
