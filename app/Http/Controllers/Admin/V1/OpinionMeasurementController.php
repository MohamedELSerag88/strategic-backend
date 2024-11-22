<?php

namespace App\Http\Controllers\Admin\V1;

use App\Http\Controllers\Controller;
use App\Http\Filters\KeySearchPipeline;
use App\Http\Filters\PaginationPipeline;
use App\Http\Filters\SortPipeline;
use App\Http\Requests\Admin\OpinionMeasurementRequest;
use App\Http\Resources\Admin\OpinionMeasurementResource;
use App\Models\OpinionMeasurement;
use App\Models\OpinionServices;
use Illuminate\Pipeline\Pipeline;

class OpinionMeasurementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = app(Pipeline::class)
            ->send(OpinionMeasurement::query())
            ->through([
                PaginationPipeline::class,
                KeySearchPipeline::class,
                SortPipeline::class,
            ])
            ->thenReturn();
        $collection = OpinionMeasurementResource::collection($events);
        $data = $this->getPaginatedResponse($events, $collection);
        return $this->response->statusOk($data);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(OpinionMeasurementRequest $request)
    {
        $data = $request->validated();
        $serviceableData = $data['serviceable_data'];
        $opinionIds = $data['opinion_ids'];
        unset($data['opinion_ids'], $data['serviceable_data']);
        $opinion = OpinionMeasurement::create($data);
        $opinion->opinions()->attach($opinionIds);
        $serviceableData = array_map(function ($item) use($opinion){
            $item['measurement_id'] = $opinion->id;
            return $item;
        },$serviceableData);
        \DB::table('opinion_serviceable')->insert($serviceableData);
        return $this->response->statusOk("Opinion Measurement created successfully");

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $event = OpinionMeasurement::where('id' ,$id)->first();
        if(!$event){
            return $this->response->statusFail("Opinion Measurement not found");
        }

        return $this->response->statusOk(["data" => new OpinionMeasurementResource($event)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OpinionMeasurementRequest $request, $id)
    {
        $data = $request->validated();
        $opinion = OpinionMeasurement::where('id' ,$id)->first();
        if(!$opinion){
            return $this->response->statusFail("Opinion Measurement not found");
        }
        $serviceable_data = $data['serviceable_data'];
        $opinionIds = $data['opinion_ids'];
        unset($data['opinion_ids'], $data['serviceable_data']);
        $opinion->opinions()->sync($opinionIds);
        OpinionMeasurement::where('id' ,$id)->update($data);
        $serviceable_data = array_map(function ($item) use($opinion){
            $item['measurement_id'] = $opinion->id;
            return $item;
        },$serviceable_data);
        OpinionServices::where('measurement_id' ,$id)->delete();
        \DB::table('opinion_serviceable')->insert($serviceable_data);
        return $this->response->statusOk("Opinion Measurement updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $opinion = OpinionMeasurement::where('id' ,$id)->first();
        if(!$opinion){
            return $this->response->statusFail("Opinion Measurement not found");
        }
        OpinionServices::where('measurement_id' ,$id)->orWhere([
            'serviceable_type'=> OpinionMeasurement::class,
            'serviceable_id'=>$id
        ])->delete();
        OpinionMeasurement::where('id' ,$id)->delete();
        return $this->response->statusOk("Opinion Measurement deleted successfully");
    }
}
