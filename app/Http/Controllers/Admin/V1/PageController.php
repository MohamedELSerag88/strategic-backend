<?php

namespace App\Http\Controllers\Admin\V1;

use App\Http\Controllers\Controller;
use App\Http\Filters\PaginationPipeline;
use App\Http\Filters\SortPipeline;
use App\Http\Requests\Admin\PageRequest;
use App\Http\Resources\Admin\PageResource;
use App\Models\Page;
use Illuminate\Pipeline\Pipeline;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pages = app(Pipeline::class)
            ->send(Page::query())
            ->through([
                PaginationPipeline::class,
                SortPipeline::class,
            ])
            ->thenReturn();
        $collection = PageResource::collection($pages);
        $data = $this->getPaginatedResponse($pages, $collection);
        return $this->response->statusOk($data);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(PageRequest $request)
    {
        $data = $request->validated();
        $data['slug'] =str_replace(" ","",$data['name']);;
        $page = Page::create($data);
        return $this->response->statusOk("Page created successfully");

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $page = Page::where('id' ,$id)->first();
        if(!$page){
            return $this->response->statusFail("page not found");
        }

        return $this->response->statusOk(["data" => new PageResource($page)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PageRequest $request, $id)
    {
        $data = $request->validated();
        $page = Page::where('id' ,$id)->first();
        if(!$page){
            return $this->response->statusFail("page not found");
        }
        Page::where('id' ,$id)->update($data);
        return $this->response->statusOk("page updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $page = Page::where('id' ,$id)->first();
        if(!$page){
            return $this->response->statusFail("page not found");
        }

        Page::where('id' ,$id)->delete();
        return $this->response->statusOk("page deleted successfully");
    }
}
