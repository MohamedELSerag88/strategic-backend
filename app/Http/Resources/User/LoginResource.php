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
            "name" => $this->fname ,
            "email" => $this->lname ,
            "phone" => $this->email ,
            "photo" => $this->phone,
            "job" => $this->photo,
            "token" => $this->token,
        ];
    }
}