<?php

namespace App\Http\Controllers\Admin\V1;

use App\Http\Controllers\Controller;
use App\Http\Filters\KeySearchPipeline;
use App\Http\Filters\PaginationPipeline;
use App\Http\Filters\SortPipeline;
use App\Http\Requests\Admin\ConsultationRequest;
use App\Http\Resources\Admin\ConsultationResource;
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
     * Store a newly created resource in storage.
     */
    public function store(ConsultationRequest $request)
    {
        $data = $request->validated();
        $relatedConsultationsId = $data['relatedConsultations_id'];
        unset($data['relatedConsultations_id']);
        $consultation = Consultation::create($data);
        $consultation->consultations()->attach($relatedConsultationsId);
        return $this->response->statusOk("Consultation created successfully");

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

        return $this->response->statusOk(["data" => new ConsultationResource($consultation)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ConsultationRequest $request, $id)
    {
        $data = $request->validated();
        $consultation = Consultation::where('id' ,$id)->first();
        if(!$consultation){
            return $this->response->statusFail("consultation not found");
        }
        $relatedConsultationsId = $data['relatedConsultations_id'];
        unset($data['relatedConsultations_id']);
        Consultation::where('id' ,$id)->update($data);
        $consultation->consultations()->sync($relatedConsultationsId);
        return $this->response->statusOk("consultation updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $consultation = Consultation::where('id' ,$id)->first();
        if(!$consultation){
            return $this->response->statusFail("consultation not found");
        }

        Consultation::where('id' ,$id)->delete();
        return $this->response->statusOk("consultation deleted successfully");
    }
}
