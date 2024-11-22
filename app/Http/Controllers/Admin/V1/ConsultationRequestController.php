<?php

namespace App\Http\Controllers\Admin\V1;

use App\Http\Controllers\Controller;
use App\Http\Filters\PaginationPipeline;
use App\Http\Filters\SortPipeline;
use App\Http\Requests\Admin\ConsultationRequestRequest;
use App\Http\Resources\Admin\ConsultationRequestResource;
use App\Models\ConsultationRequest;
use Illuminate\Pipeline\Pipeline;
class ConsultationRequestController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $memberships = app(Pipeline::class)
            ->send(ConsultationRequest::query())
            ->through([
                PaginationPipeline::class,
                SortPipeline::class,
            ])
            ->thenReturn();
        $collection = ConsultationRequestResource::collection($memberships);
        $data = $this->getPaginatedResponse($memberships, $collection);
        return $this->response->statusOk($data);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $membership = ConsultationRequest::find($id);
        if(!$membership){
            return $this->response->statusFail("Consultation Request not found");
        }

        return $this->response->statusOk(["data" => new ConsultationRequestResource($membership)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ConsultationRequestRequest $request, $id)
    {
        $data = $request->validated();
        $membership = ConsultationRequest::where('id' ,$id)->first();
        if(!$membership){
            return $this->response->statusFail("Consultation Request not found");
        }
        ConsultationRequest::where('id' ,$id)->update($data);
        return $this->response->statusOk("ConsultationRequest updated successfully");
    }


}
