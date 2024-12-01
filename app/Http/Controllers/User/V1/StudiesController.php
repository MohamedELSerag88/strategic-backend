<?php

namespace App\Http\Controllers\User\V1;

use App\Http\Controllers\Controller;
use App\Http\Filters\KeySearchPipeline;
use App\Http\Filters\PaginationPipeline;
use App\Http\Filters\RelationPipeline;
use App\Http\Filters\SortPipeline;
use App\Http\Requests\Admin\StudyRequest;
use App\Http\Resources\User\StudyResource;
use App\Models\Study;
use Illuminate\Pipeline\Pipeline;

class StudiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = app(Pipeline::class)
            ->send(Study::query()->where('status',1))
            ->through([
                PaginationPipeline::class,
                RelationPipeline::class,
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
        $data['status'] = 0;
        $studyIds = $data['study_ids'];
        unset($data['study_ids']);
        $study = Study::create($data);
        $study->studies()->attach($studyIds);
        return $this->response->statusOk("Study created successfully");

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $event = Study::where('id' ,$id)->first();
        if(!$event){
            return $this->response->statusFail("event not found");
        }
        $event->method = "get";
        return $this->response->statusOk(["data" => new StudyResource($event)]);
    }


}
