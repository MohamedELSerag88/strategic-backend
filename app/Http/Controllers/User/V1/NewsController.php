<?php

namespace App\Http\Controllers\User\V1;

use App\Http\Controllers\Controller;
use App\Http\Filters\KeySearchPipeline;
use App\Http\Filters\PaginationPipeline;
use App\Http\Filters\RelationPipeline;
use App\Http\Filters\SortPipeline;
use App\Http\Resources\User\ExpertResource;
use App\Http\Resources\User\NewsResource;
use App\Models\Expert;
use App\Models\News;
use Illuminate\Pipeline\Pipeline;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = app(Pipeline::class)
            ->send(News::query())
            ->through([
                PaginationPipeline::class,
                RelationPipeline::class,
                KeySearchPipeline::class,
                SortPipeline::class,
            ])
            ->thenReturn();
        $collection = NewsResource::collection($events);
        $data = $this->getPaginatedResponse($events, $collection);
        return $this->response->statusOk($data);
    }




    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $event = News::where('id' ,$id)->first();
        if(!$event){
            return $this->response->statusFail("News not found");
        }
        $event->method = "get";
        return $this->response->statusOk(["data" => new NewsResource($event)]);
    }


}
