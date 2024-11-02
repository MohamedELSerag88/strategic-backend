<?php

namespace App\Http\Controllers\Admin\V1;

use App\Http\Controllers\Controller;
use App\Http\Filters\PaginationPipeline;
use App\Http\Filters\SortPipeline;
use App\Http\Requests\Admin\AdminRequest;
use App\Http\Requests\Admin\UserRequest;
use App\Http\Resources\Admin\AdminResource;
use App\Http\Resources\Admin\UserResource;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Pipeline\Pipeline;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = app(Pipeline::class)
            ->send(User::query())
            ->through([
                PaginationPipeline::class,
                SortPipeline::class,
            ])
            ->thenReturn();
        $collection = UserResource::collection($users);
        $data = $this->getPaginatedResponse($users, $collection);
        return $this->response->statusOk($data);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $data = $request->validated();
        $data['password'] =\Hash::make($data['password']);
        User::create($data);
        return $this->response->statusOk("User created successfully");

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::where('id' ,$id)->first();
        if(!$user){
            return $this->response->statusFail("User not found");
        }

        return $this->response->statusOk(["data" => new UserResource($user)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, $id)
    {
        $data = $request->validated();
        $user = User::where('id' ,$id)->first();
        if(!$user){
            return $this->response->statusFail("User not found");
        }
        User::where('id' ,$id)->update($data);
        return $this->response->statusOk("User updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::where('id' ,$id)->first();
        if(!$user){
            return $this->response->statusFail("admin not found");
        }

        User::where('id' ,$id)->delete();
        return $this->response->statusOk("User deleted successfully");
    }
}
