<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LoginOtpResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "fname" => $this->fname ,
            "lname" => $this->lname ,
            "email" => $this->email ,
            "phone" => $this->phone,
            "photo" => $this->photo,
            "client_id" => $this->client_id,
            "token" => $this->token,
            "first_time_login" => $this->first_time_login,
            "clients" => ClientResource::collection($this->clients)
        ];
    }
}
