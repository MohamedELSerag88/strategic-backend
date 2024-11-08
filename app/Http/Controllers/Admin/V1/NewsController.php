<?php

namespace App\Http\Controllers\Admin\V1;

use App\Http\Controllers\Controller;
use App\Http\Filters\KeySearchPipeline;
use App\Http\Filters\PaginationPipeline;
use App\Http\Filters\SortPipeline;
use App\Http\Requests\Admin\NewsRequest;
use App\Http\Resources\Admin\NewsResource;
use App\Models\News;
use Illuminate\Pipeline\Pipeline;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $newss = app(Pipeline::class)
            ->send(News::query())
            ->through([
                PaginationPipeline::class,
                KeySearchPipeline::class,
                SortPipeline::class,
            ])
            ->thenReturn();
        $collection = NewsResource::collection($newss);
        $data = $this->getPaginatedResponse($newss, $collection);
        return $this->response->statusOk($data);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(NewsRequest $request)
    {
        $data = $request->validated();
        $relatedNewsId = $data['relatedNews_id'];
        unset($data['relatedNews_id']);
        $news = News::create($data);
        $news->news()->attach($relatedNewsId);
        return $this->response->statusOk("News created successfully");

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $news = News::where('id' ,$id)->first();
        if(!$news){
            return $this->response->statusFail("news not found");
        }

        return $this->response->statusOk(["data" => new NewsResource($news)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NewsRequest $request, $id)
    {
        $data = $request->validated();
        $news = News::where('id' ,$id)->first();
        if(!$news){
            return $this->response->statusFail("news not found");
        }
        $relatedNewsId = $data['relatedNews_id'];
        unset($data['relatedNews_id']);
        News::where('id' ,$id)->update($data);
        $news->news()->sync($relatedNewsId);
        return $this->response->statusOk("news updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $news = News::where('id' ,$id)->first();
        if(!$news){
            return $this->response->statusFail("news not found");
        }

        News::where('id' ,$id)->delete();
        return $this->response->statusOk("news deleted successfully");
    }
}
