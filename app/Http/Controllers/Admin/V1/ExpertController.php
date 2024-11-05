<?php

namespace App\Http\Controllers\Admin\V1;

use App\Http\Controllers\Controller;
use App\Http\Filters\KeySearchPipeline;
use App\Http\Filters\PaginationPipeline;
use App\Http\Filters\SortPipeline;
use App\Http\Requests\Admin\ExpertRequest;
use App\Http\Resources\Admin\ExpertResource;
use App\Models\Expert;
use Illuminate\Pipeline\Pipeline;

class ExpertController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $experts = app(Pipeline::class)
            ->send(Expert::query())
            ->through([
                PaginationPipeline::class,
                KeySearchPipeline::class,
                SortPipeline::class,
            ])
            ->thenReturn();
        $collection = ExpertResource::collection($experts);
        $data = $this->getPaginatedResponse($experts, $collection);
        return $this->response->statusOk($data);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(ExpertRequest $request)
    {
        $data = $request->validated();
        Expert::create($data);
        return $this->response->statusOk("Expert created successfully");

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $expert = Expert::where('id' ,$id)->first();
        if(!$expert){
            return $this->response->statusFail("expert not found");
        }

        return $this->response->statusOk(["data" => new ExpertResource($expert)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ExpertRequest $request, $id)
    {
        $data = $request->validated();
        $expert = Expert::where('id' ,$id)->first();
        if(!$expert){
            return $this->response->statusFail("expert not found");
        }
        Expert::where('id' ,$id)->update($data);
        return $this->response->statusOk("expert updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $expert = Expert::where('id' ,$id)->first();
        if(!$expert){
            return $this->response->statusFail("expert not found");
        }

        Expert::where('id' ,$id)->delete();
        return $this->response->statusOk("expert deleted successfully");
    }
}
