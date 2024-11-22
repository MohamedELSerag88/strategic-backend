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
            "name" => $this->name ,
            "type" => $this->type ,
            "duration" => $this->duration ,
            "job" => $this->job,
            "nationality" => $this->nationality,
            "resident_country" => $this->resident_country,
            "email" => $this->email,
            "phone" => $this->phone,
            "contact_type" => $this->contact_type,
            "organization_name" => $this->organization_name,
            "photo" => $this->photo,
            "status" => $this->status,
        ];
    }
}
