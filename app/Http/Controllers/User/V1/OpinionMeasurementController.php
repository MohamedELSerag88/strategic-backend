<?php

namespace App\Http\Controllers\User\V1;

use App\Http\Controllers\Controller;
use App\Http\Filters\KeySearchPipeline;
use App\Http\Filters\PaginationPipeline;
use App\Http\Filters\RelationPipeline;
use App\Http\Filters\SortPipeline;
use App\Http\Resources\User\OpinionMeasurementResource;
use App\Models\OpinionMeasurement;
use Illuminate\Pipeline\Pipeline;

class OpinionMeasurementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $opinionMeasurements = app(Pipeline::class)
            ->send(OpinionMeasurement::query())
            ->through([
                PaginationPipeline::class,
                RelationPipeline::class,
                KeySearchPipeline::class,
                SortPipeline::class,
            ])
            ->thenReturn();
        $collection = OpinionMeasurementResource::collection($opinionMeasurements);
        $data = $this->getPaginatedResponse($opinionMeasurements, $collection);
        return $this->response->statusOk($data);
    }




    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $opinionMeasurement = OpinionMeasurement::where('id' ,$id)->first();
        if(!$opinionMeasurement){
            return $this->response->statusFail("Opinion Measurement not found");
        }
        $opinionMeasurement->method = "show";
        return $this->response->statusOk(["data" => new OpinionMeasurementResource($opinionMeasurement)]);
    }


}
