<?php

namespace App\Http\Resources\Admin\Auth;

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
            "photo" => $this->photo,
            "role" => $this->role,
            "features" => $this->role->permissions->map(function($item){
                return [
                    $item->key =>$item->pivot
                ];
            }),
            "menus" =>  $this->role->permissions->map(function($item){
                return $item->key;
            }),
            "token" => $this->token,
        ];
    }
}
