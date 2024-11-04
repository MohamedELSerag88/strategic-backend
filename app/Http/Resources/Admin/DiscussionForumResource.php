<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DiscussionForumResource extends JsonResource
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
            "participants" => $this->participants ,
            "start_date" => $this->start_date ,
            "end_date" => $this->end_date ,
            "content" => $this->content ,
            "discussion_forum_id" => $this->discussion_forum_id ,
        ];
    }
}
