<?php

namespace App\Http\Controllers\Admin\V1;

use App\Http\Controllers\Controller;
use App\Http\Filters\PaginationPipeline;
use App\Http\Filters\SortPipeline;
use App\Http\Requests\Admin\AdminRequest;
use App\Http\Resources\Admin\AdminResource;
use App\Models\Admin;
use Illuminate\Pipeline\Pipeline;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = app(Pipeline::class)
            ->send(Admin::query())
            ->through([
                PaginationPipeline::class,
                SortPipeline::class,
            ])
            ->thenReturn();
        $collection = AdminResource::collection($admins);
        $data = $this->getPaginatedResponse($admins, $collection);
        return $this->response->statusOk($data);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminRequest $request)
    {
        $data = $request->validated();
        $data['password'] =\Hash::make($data['password']);
        $admin = Admin::create($data);
        return $this->response->statusOk("Admin created successfully");

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $admin = Admin::where('id' ,$id)->first();
        if(!$admin){
            return $this->response->statusFail("admin not found");
        }

        return $this->response->statusOk(["data" => new AdminResource($admin)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminRequest $request, $id)
    {
        $data = $request->validated();
        $admin = Admin::where('id' ,$id)->first();
        if(!$admin){
            return $this->response->statusFail("admin not found");
        }
        Admin::where('id' ,$id)->update($data);
        return $this->response->statusOk("admin updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $admin = Admin::where('id' ,$id)->first();
        if(!$admin){
            return $this->response->statusFail("admin not found");
        }

        Admin::where('id' ,$id)->delete();
        return $this->response->statusOk("admin deleted successfully");
    }
}
