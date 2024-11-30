<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventRequestResource extends JsonResource
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
            "event" => [
                "id"=>$this->event_id ,
                "name" => $this->event?->title
            ],
            "event_type" => $this->event_type ,
            "event_presentation" => $this->event_presentation ,
            "name" => $this->name,
            "job" => $this->job,
            "org_type" => $this->org_type,
            "phone" => $this->phone,
            "org_name" => $this->org_name,
            "headquarter_country" => $this->headquarter_country,
            "event_id" => $this->event_id ,
            "event_name" => $this->event->name,
            "event_country" => $this->event_country,
            "event_date" => $this->event_date,
            "note" => $this->note

        ];
    }
}
