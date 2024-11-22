<?php

namespace App\Http\Controllers\Admin\V1;

use App\Http\Controllers\Controller;
use App\Http\Filters\KeySearchPipeline;
use App\Http\Filters\PaginationPipeline;
use App\Http\Filters\SortPipeline;
use App\Http\Requests\Admin\DiscussionForumRequest;
use App\Http\Resources\Admin\DiscussionForumResource;
use App\Models\DiscussionForum;
use App\Models\ForumServices;
use App\Models\OpinionServices;
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
     * Store a newly created resource in storage.
     */
    public function store(DiscussionForumRequest $request)
    {
        $data = $request->validated();
        $serviceableData = $data['serviceable_data'];
        $forumIds = $data['forum_ids'];
        unset($data['forum_ids'], $data['serviceable_data']);
        $forum = DiscussionForum::create($data);
        $forum->forums()->attach($forumIds);
        $serviceableData = array_map(function ($item) use($forum){
            $item['discussion_forum_id'] = $forum->id;
            return $item;
        },$serviceableData);
        \DB::table('forum_serviceable')->insert($serviceableData);
        return $this->response->statusOk("Discussion Forum created successfully");

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

    /**
     * Update the specified resource in storage.
     */
    public function update(DiscussionForumRequest $request, $id)
    {
        $data = $request->validated();
        $forum = DiscussionForum::where('id' ,$id)->first();
        if(!$forum){
            return $this->response->statusFail("Discussion Forum not found");
        }
        $serviceable_data = $data['serviceable_data'];
        $forumIds = $data['forum_ids'];
        unset($data['forum_ids'], $data['serviceable_data']);
        $forum->forums()->sync($forumIds);
        DiscussionForum::where('id' ,$id)->update($data);
        $serviceable_data = array_map(function ($item) use($forum){
            $item['discussion_forum_id'] = $forum->id;
            return $item;
        },$serviceable_data);
        ForumServices::where('discussion_forum_id' ,$id)->delete();
        \DB::table('forum_serviceable')->insert($serviceable_data);
        return $this->response->statusOk("Discussion Forum updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $forum = DiscussionForum::where('id' ,$id)->first();
        if(!$forum){
            return $this->response->statusFail("Discussion Forum not found");
        }
        ForumServices::where('discussion_forum_id' ,$id)->orWhere([
            'serviceable_type'=> DiscussionForum::class,
            'serviceable_id'=>$id
        ])->delete();
        DiscussionForum::where('id' ,$id)->delete();
        return $this->response->statusOk("Discussion Forum deleted successfully");
    }
}
