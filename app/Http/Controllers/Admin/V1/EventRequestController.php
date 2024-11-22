<?php

namespace App\Http\Controllers\Admin\V1;

use App\Http\Controllers\Controller;
use App\Http\Filters\PaginationPipeline;
use Illuminate\Pipeline\Pipeline;
use App\Http\Filters\SortPipeline;
use App\Http\Requests\Admin\EventRequestRequest;
use App\Http\Resources\Admin\EventRequestResource;
use App\Models\EventRequest;

class EventRequestController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $eventRequest = app(Pipeline::class)
            ->send(EventRequest::query())
            ->through([
                PaginationPipeline::class,
                SortPipeline::class,
            ])
            ->thenReturn();
        $collection = EventRequestResource::collection($eventRequest);
        $data = $this->getPaginatedResponse($eventRequest, $collection);
        return $this->response->statusOk($data);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $eventRequest = EventRequest::find($id);
        if(!$eventRequest){
            return $this->response->statusFail("Event Request Request not found");
        }

        return $this->response->statusOk(["data" => new EventRequestResource($eventRequest)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EventRequestRequest $request, $id)
    {
        $data = $request->validated();
        $eventRequest = EventRequest::where('id' ,$id)->first();
        if(!$eventRequest){
            return $this->response->statusFail("EventRequest Request not found");
        }
        EventRequest::where('id' ,$id)->update($data);
        return $this->response->statusOk("Event Request updated successfully");
    }


}
