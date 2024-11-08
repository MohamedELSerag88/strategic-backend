<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;


class MediaResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'   => $this->id ?? "",
            'path' => $this->path ? url($this->path) : ""
        ];
    }
}
