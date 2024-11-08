<?php

namespace App\Http\Controllers\Admin\V1;

use App\Http\Controllers\Controller;
use App\Http\Filters\KeySearchPipeline;
use App\Http\Filters\PaginationPipeline;
use App\Http\Filters\SortPipeline;
use App\Http\Requests\Admin\EventRequest;
use App\Http\Resources\Admin\EventResource;
use App\Models\Event;
use App\Models\EventDate;
use App\Models\EventServices;
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
                KeySearchPipeline::class,
                SortPipeline::class,
            ])
            ->thenReturn();
        $collection = EventResource::collection($events);
        $data = $this->getPaginatedResponse($events, $collection);
        return $this->response->statusOk($data);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(EventRequest $request)
    {
        $data = $request->validated();

        $eventDate = [
            "month" =>$data['month'],
            "week_number"=>$data['week_number'],
            "from_date" =>$data['from_date'],
            "to_date" =>$data['to_date'],
        ];
        unset($data['month'], $data['week_number'], $data['from_date'], $data['to_date']);
        $serviceable_data = $data['serviceable_data'];
        unset($data['serviceable_data']);
        $event = Event::create($data);
        $eventDate['event_id'] = $event->id;
        $serviceable_data = array_map(function ($item) use($event){
            $item['event_id'] = $event->id;
            return $item;
        },$serviceable_data);
        \DB::table('event_serviceable')->insert($serviceable_data);
        EventDate::create($eventDate);
        return $this->response->statusOk("Event created successfully");

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

        return $this->response->statusOk(["data" => new EventResource($event)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EventRequest $request, $id)
    {
        $data = $request->validated();
        $event = Event::where('id' ,$id)->first();
        if(!$event){
            return $this->response->statusFail("event not found");
        }
        $serviceable_data = $data['serviceable_data'];
        unset($data['serviceable_data']);
        $eventDate = [
            "month" =>$data['month'],
            "week_number"=>$data['week_number'],
            "from_date" =>$data['from_date'],
            "to_date" =>$data['to_date'],
        ];
        unset($data['month'], $data['week_number'], $data['from_date'], $data['to_date']);
        Event::where('id' ,$id)->update($data);
        EventDate::where('event_id' ,$id)->update($eventDate);
        $serviceable_data = array_map(function ($item) use($event){
            $item['event_id'] = $event->id;
            return $item;
        },$serviceable_data);
        EventServices::where('event_id' ,$id)->delete();
        \DB::table('event_serviceable')->insert($serviceable_data);
        return $this->response->statusOk("event updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $event = Event::where('id' ,$id)->first();
        if(!$event){
            return $this->response->statusFail("event not found");
        }

        Event::where('id' ,$id)->delete();
        return $this->response->statusOk("event deleted successfully");
    }
}
