<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ConsultationRequestResource extends JsonResource
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
            "job_position" => $this->job_position ,
            "email" => $this->email ,
            "phone" => $this->phone ,
            "org_status" => $this->org_status ,
            "org_name" => $this->org_name ,
            "org_type" => $this->org_type ,
            "establishment_date" => $this->establishment_date ,
            "ownership_type" => $this->ownership_type ,
            "means_type" => $this->means_type ,
            "headquarter_country" => $this->headquarter_country ,
            "employees_number" => $this->employees_number,
            "external_offices_number" => $this->external_offices_number,
            "annual_budget" => $this->annual_budget,
            "suffers_area" => $this->suffers_area,
            "notes" => $this->notes,
            "status" => $this->status,
        ];
    }
}
