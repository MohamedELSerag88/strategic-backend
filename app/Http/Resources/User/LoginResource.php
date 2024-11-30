<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LoginResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "name" => $this->name ,
            "email" => $this->email ,
            "phone" => $this->phone ,
            "photo" => $this->photo,
            "job" => $this->job,
            "token" => $this->token,
            "expire" => $this->expire,
        ];
    }
}
