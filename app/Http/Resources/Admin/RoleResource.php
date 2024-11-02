<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
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
            "status" => $this->status ,
            "permissions" => $this->permissions->map(function ($item){
                return [
                    'id' =>$item->id,
                    'has_read' => $item->pivot->has_read,
                    'has_create' => $item->pivot->has_create,
                    'has_update' => $item->pivot->has_update,
                    'has_delete' => $item->pivot->has_delete
                ];
            }),
            "features" => implode(', ',$this->permissions->pluck('key')->toArray() ),
        ];
    }
}
