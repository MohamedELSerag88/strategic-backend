<?php

namespace App\Http\Controllers\Admin\V1;

use App\Http\Controllers\Controller;
use App\Http\Filters\PaginationPipeline;
use App\Http\Filters\SortPipeline;
use App\Http\Requests\Admin\CategoryRequest;
use App\Http\Resources\Admin\CategoryResource;
use App\Models\Category;
use Illuminate\Pipeline\Pipeline;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorys = app(Pipeline::class)
            ->send(Category::query())
            ->through([
                PaginationPipeline::class,
                SortPipeline::class,
            ])
            ->thenReturn();
        $collection = CategoryResource::collection($categorys);
        $data = $this->getPaginatedResponse($categorys, $collection);
        return $this->response->statusOk($data);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $data = $request->validated();
        Category::create($data);
        return $this->response->statusOk("Category created successfully");

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $category = Category::where('id' ,$id)->first();
        if(!$category){
            return $this->response->statusFail("category not found");
        }

        return $this->response->statusOk(["data" => new CategoryResource($category)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, $id)
    {
        $data = $request->validated();
        $category = Category::where('id' ,$id)->first();
        if(!$category){
            return $this->response->statusFail("category not found");
        }
        Category::where('id' ,$id)->update($data);
        return $this->response->statusOk("category updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Category::where('id' ,$id)->first();
        if(!$category){
            return $this->response->statusFail("category not found");
        }

        Category::where('id' ,$id)->delete();
        return $this->response->statusOk("category deleted successfully");
    }
}
