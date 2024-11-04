<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OpinionMeasurementResource extends JsonResource
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
            "targeted_segment" => $this->targeted_segment ,
            "geographical_scope" => $this->geographical_scope ,
            "participants" => $this->participants ,
            "start_date" => $this->start_date ,
            "end_date" => $this->end_date ,
            "expert_id" => $this->expert_id ,
            "opinion_measurement_id" => $this->opinion_measurement_id ,
        ];
    }
}
