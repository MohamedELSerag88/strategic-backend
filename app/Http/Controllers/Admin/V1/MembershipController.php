<?php

namespace App\Http\Controllers\Admin\V1;

use App\Http\Controllers\Controller;
use App\Http\Filters\PaginationPipeline;
use App\Http\Filters\SortPipeline;
use App\Http\Requests\Admin\MembershipRequest;
use App\Http\Resources\Admin\MembershipResource;
use App\Models\Membership;
use Illuminate\Pipeline\Pipeline;

class MembershipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $memberships = app(Pipeline::class)
            ->send(Membership::query())
            ->through([
                PaginationPipeline::class,
                SortPipeline::class,
            ])
            ->thenReturn();
        $collection = MembershipResource::collection($memberships);
        $data = $this->getPaginatedResponse($memberships, $collection);
        return $this->response->statusOk($data);
    }




    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $membership = Membership::find($id);
        if(!$membership){
            return $this->response->statusFail("membership not found");
        }

        return $this->response->statusOk(["data" => new MembershipResource($membership)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MembershipRequest $request, $id)
    {
        $data = $request->validated();
        $membership = Membership::where('id' ,$id)->first();
        if(!$membership){
            return $this->response->statusFail("membership not found");
        }
        Membership::where('id' ,$id)->update($data);
        return $this->response->statusOk("membership updated successfully");
    }


}
