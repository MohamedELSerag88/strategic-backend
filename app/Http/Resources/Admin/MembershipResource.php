<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MembershipResource extends JsonResource
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
            "duration" => $this->duration ,
            "start_date" => $this->start_date,
            "end_date" => $this->end_date,
            "job" => $this->job,
            "nationality" => $this->nationality,
            "resident_country" => $this->resident_country,
            "phone" => $this->phone,
            "user" => new UserResource($this->user)
        ];
    }
}
