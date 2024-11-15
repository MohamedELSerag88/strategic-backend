<?php

namespace App\Http\Controllers\Admin\V1;

use App\Http\Controllers\Controller;
use App\Http\Filters\KeySearchPipeline;
use App\Http\Filters\PaginationPipeline;
use App\Http\Filters\SortPipeline;
use App\Http\Requests\Admin\EventRequest;
use App\Http\Requests\Admin\StudyRequest;
use App\Http\Resources\Admin\EventResource;
use App\Http\Resources\Admin\StudyResource;
use App\Models\Event;
use App\Models\EventDate;
use App\Models\EventServices;
use App\Models\Study;
use App\Models\StudyServices;
use Illuminate\Pipeline\Pipeline;

class StudyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = app(Pipeline::class)
            ->send(Study::query())
            ->through([
                PaginationPipeline::class,
                KeySearchPipeline::class,
                SortPipeline::class,
            ])
            ->thenReturn();
        $collection = StudyResource::collection($events);
        $data = $this->getPaginatedResponse($events, $collection);
        return $this->response->statusOk($data);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StudyRequest $request)
    {
        $data = $request->validated();
        $serviceableData = $data['serviceable_data'];
        $studyIds = $data['study_ids'];
        unset($data['study_ids'], $data['serviceable_data']);
        $study = Study::create($data);
        $study->studies()->attach($studyIds);
        $serviceableData = array_map(function ($item) use($study){
            $item['study_id'] = $study->id;
            return $item;
        },$serviceableData);
        \DB::table('study_serviceable')->insert($serviceableData);
        return $this->response->statusOk("Study created successfully");

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $event = Study::where('id' ,$id)->first();
        if(!$event){
            return $this->response->statusFail("Study not found");
        }

        return $this->response->statusOk(["data" => new StudyResource($event)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StudyRequest $request, $id)
    {
        $data = $request->validated();
        $study = Study::where('id' ,$id)->first();
        if(!$study){
            return $this->response->statusFail("event not found");
        }
        $serviceable_data = $data['serviceable_data'];
        $studyIds = $data['study_ids'];
        unset($data['study_ids'], $data['serviceable_data']);
        $study->studies()->sync($studyIds);
        Study::where('id' ,$id)->update($data);
        $serviceable_data = array_map(function ($item) use($study){
            $item['study_id'] = $study->id;
            return $item;
        },$serviceable_data);
        StudyServices::where('study_id' ,$id)->delete();
        \DB::table('study_serviceable')->insert($serviceable_data);
        return $this->response->statusOk("study updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $study = Study::where('id' ,$id)->first();
        if(!$study){
            return $this->response->statusFail("study not found");
        }
        StudyServices::where('study_id' ,$id)->orWhere([
            'serviceable_type'=> Study::class,
            'serviceable_id'=>$id
        ])->delete();
        Study::where('id' ,$id)->delete();
        return $this->response->statusOk("study deleted successfully");
    }
}
