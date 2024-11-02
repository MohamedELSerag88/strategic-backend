<?php

namespace App\Http\Controllers\Admin\V1;

use App\Http\Controllers\Controller;
use App\Http\Filters\PaginationPipeline;
use App\Http\Filters\SortPipeline;
use App\Http\Requests\Admin\RoleRequest;
use App\Http\Resources\Admin\RoleResource;
use App\Models\Role;
use Illuminate\Pipeline\Pipeline;

class RoleController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = app(Pipeline::class)
            ->send(Role::query())
            ->through([
                PaginationPipeline::class,
                SortPipeline::class,
            ])
            ->thenReturn();
        $collection = RoleResource::collection($roles);
        $data = $this->getPaginatedResponse($roles, $collection);
        return $this->response->statusOk($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request)
    {
        $data = $request->validated();
        $features = $request->get('features');
        unset($data['features']);
        $role = Role::create($data);
        foreach ($features as $feature){
            $feature_id = $feature['id'];
            $pivotData=[
                'has_read' =>0,
                'has_create' =>0,
                'has_update' =>0,
                'has_delete' =>0
            ];
            if(isset($feature['has_read']) ){
                $pivotData['has_read'] = $feature['has_read'];
            }
            if(isset($feature['has_create']) ){
                $pivotData['has_create'] = $feature['has_create'];
                $pivotData['has_read'] = $feature['has_create'] ? 1:0;
            }
            if(isset($feature['has_update']) ){
                $pivotData['has_update'] = $feature['has_update'];
                $pivotData['has_read'] = $feature['has_update'] ? 1:0;
            }
            if(isset($feature['has_delete']) ){
                $pivotData['has_delete'] = $feature['has_delete'];
                $pivotData['has_read'] = $feature['has_delete'] ? 1:0;
            }
            $role->permissions()->attach($feature_id,$pivotData);
        }
        return $this->response->statusOk('Role created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $role = Role::where('id' ,$id)->first();
        if(!$role){
            return $this->response->statusFail('Role not found');
        }

        return $this->response->statusOk(["data" => new RoleResource($role)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleRequest $request, $id)
    {
        $data = $request->validated();
        $role = Role::where('id' ,$id)->first();
        if(!$role){
            return $this->response->statusFail('Role not found');
        }
        $features = $data['features'];
        unset($data['features']);
        Role::where('id' ,$id)->update($data);
        $role->permissions()->detach($role->permissions->pluck('id')->toArray());
        foreach ($features as $feature){
            $feature_id = $feature['id'];
            unset($feature['id']);
            $pivotData=[
                'has_read' =>0,
                'has_create' =>0,
                'has_update' =>0,
                'has_delete' =>0
            ];
            if(isset($feature['has_read']) ){
                $pivotData['has_read'] = $feature['has_read'];
            }
            if(isset($feature['has_create']) ){
                $pivotData['has_create'] = $feature['has_create'];
                $pivotData['has_read'] = $feature['has_create'] ? 1:0;
            }
            if(isset($feature['has_update']) ){
                $pivotData['has_update'] = $feature['has_update'];
                $pivotData['has_read'] = $feature['has_update'] ? 1:0;
            }
            if(isset($feature['has_delete']) ){
                $pivotData['has_delete'] = $feature['has_delete'];
                $pivotData['has_read'] = $feature['has_delete'] ? 1:0;
            }
            $role->permissions()->attach($feature_id, $pivotData);
        }
        return $this->response->statusOk('Role updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $role = Role::where('id' ,$id)->first();
        if(!$role){
            return $this->response->statusFail('Role not found');
        }

        Role::where('id' ,$id)->delete();
        return $this->response->statusOk('Role deleted successfully');
    }

}
