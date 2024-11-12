<?php

namespace App\Http\Controllers\User\V1;

use App\Http\Controllers\Controller;
use App\Http\Filters\PaginationPipeline;
use App\Http\Filters\SortPipeline;
use App\Http\Resources\User\CategoryResource;
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



}
