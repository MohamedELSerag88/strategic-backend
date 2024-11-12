<?php

namespace App\Http\Controllers\User\V1;

use App\Http\Controllers\Controller;
use App\Http\Filters\KeySearchPipeline;
use App\Http\Filters\PaginationPipeline;
use App\Http\Filters\SortPipeline;
use App\Http\Resources\User\ConsultationResource;
use App\Models\Consultation;
use Illuminate\Pipeline\Pipeline;

class ConsultationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $consultations = app(Pipeline::class)
            ->send(Consultation::query())
            ->through([
                PaginationPipeline::class,
                KeySearchPipeline::class,
                SortPipeline::class,
            ])
            ->thenReturn();
        $collection = ConsultationResource::collection($consultations);
        $data = $this->getPaginatedResponse($consultations, $collection);
        return $this->response->statusOk($data);
    }




    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $consultation = Consultation::where('id' ,$id)->first();
        if(!$consultation){
            return $this->response->statusFail("consultation not found");
        }
        $consultation->method = "get";

        return $this->response->statusOk(["data" => new ConsultationResource($consultation)]);
    }




}
