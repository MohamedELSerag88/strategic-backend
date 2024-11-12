<?php

namespace App\Http\Controllers\User\V1;

use App\Http\Controllers\Controller;
use App\Http\Filters\KeySearchPipeline;
use App\Http\Filters\PaginationPipeline;
use App\Http\Filters\RelationPipeline;
use App\Http\Filters\SortPipeline;
use App\Http\Resources\User\EventResource;
use App\Models\Event;
use Illuminate\Pipeline\Pipeline;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = app(Pipeline::class)
            ->send(Event::query())
            ->through([
                PaginationPipeline::class,
                RelationPipeline::class,
                KeySearchPipeline::class,
                SortPipeline::class,
            ])
            ->thenReturn();
        $collection = EventResource::collection($events);
        $data = $this->getPaginatedResponse($events, $collection);
        return $this->response->statusOk($data);
    }




    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $event = Event::where('id' ,$id)->first();
        if(!$event){
            return $this->response->statusFail("event not found");
        }
        $event->method = "get";
        return $this->response->statusOk(["data" => new EventResource($event)]);
    }


}
