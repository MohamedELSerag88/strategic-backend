<?php

namespace App\Http\Controllers\User\V1;

use App\Http\Controllers\Controller;
use App\Http\Filters\KeySearchPipeline;
use App\Http\Filters\PaginationPipeline;
use App\Http\Filters\SortPipeline;
use App\Http\Requests\Admin\DiscussionForumRequest;
use App\Http\Resources\Admin\DiscussionForumResource;
use App\Models\DiscussionForum;
use App\Models\ForumServices;
use Illuminate\Pipeline\Pipeline;

class DiscussionForumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $forums = app(Pipeline::class)
            ->send(DiscussionForum::query())
            ->through([
                PaginationPipeline::class,
                KeySearchPipeline::class,
                SortPipeline::class,
            ])
            ->thenReturn();
        $collection = DiscussionForumResource::collection($forums);
        $data = $this->getPaginatedResponse($forums, $collection);
        return $this->response->statusOk($data);
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $forum = DiscussionForum::where('id' ,$id)->first();
        if(!$forum){
            return $this->response->statusFail("Discussion Forum not found");
        }

        return $this->response->statusOk(["data" => new DiscussionForumResource($forum)]);
    }


}
