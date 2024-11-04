<?php

namespace App\Http\Controllers\Admin\V1;

use App\Http\Controllers\Controller;
use App\Http\Filters\PaginationPipeline;
use App\Http\Filters\SortPipeline;
use App\Http\Requests\Admin\AdminRequest;
use App\Http\Requests\ResponseShape as FormRequest;
use App\Http\Response\Response;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Database\Eloquent\Model;
class AdminBaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected Model $model;
    protected JsonResource $modelResource;
    protected FormRequest $modelRequest;
    public function __construct(Model $model, JsonResource $modelResource, FormRequest $modelRequest)
    {
        $response = new Response();
        parent::__construct($response);
        $this->model = $model;
        $this->modelResource = $modelResource;
        $this->modelRequest = $modelRequest;

    }

    public function index()
    {
        $resources = app(Pipeline::class)
            ->send($this->model->query())
            ->through([
                PaginationPipeline::class,
                SortPipeline::class,
            ])
            ->thenReturn();
        $collection = $this->modelResource::collection($resources);
        $data = $this->getPaginatedResponse($resources, $collection);
        return $this->response->statusOk($data);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(FormRequest $request)
    {
        $data = $request->validated();
        $this->model->create($data);
        return $this->response->statusOk("Resource created successfully");

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $resource = $this->model->where('id' ,$id)->first();
        if(!$resource){
            return $this->response->statusFail("Resource not found");
        }

        return $this->response->statusOk(["data" => new $this->modelResource($resource)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FormRequest $request, $id)
    {
        $data = $request->validated();
        $resource = $this->model->where('id' ,$id)->first();
        if(!$resource){
            return $this->response->statusFail("Resource not found");
        }
        $this->model->where('id' ,$id)->update($data);
        return $this->response->statusOk("Resource updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $resource = $this->model->where('id' ,$id)->first();
        if(!$resource){
            return $this->response->statusFail("Resource not found");
        }

        $this->model->where('id' ,$id)->delete();
        return $this->response->statusOk("Resource deleted successfully");
    }
}
