<?php

namespace App\Http\Controllers\Admin\V1;

use App\Http\Controllers\Controller;
use App\Http\Filters\ActivePipeline;
use App\Http\Filters\RelationPipeline;
use App\Http\Resources\Admin\DropDownResource;
use Illuminate\Pipeline\Pipeline;


class DropDownController extends Controller
{
    private $model;
    const MODULENAMESPACE = 'App\Models\\';

    /**
     * @param $model
     * @return \App\Http\Response\Response
     * Return list contain id and name from provided model
     */
    public function dropDownList($model)
    {
        try {
            //create model instance
            $class = self::MODULENAMESPACE . ucfirst($model);
            $this->model = new $class();
            $q1 = $this->model::query();

            $query = app(Pipeline::class)
                ->send($q1)
                ->through([
                    ActivePipeline::class,
                    RelationPipeline::class,
                ])
                ->thenReturn()->get();
            $collection = DropDownResource::collection($query);
            return $this->response->statusOk(["data"=>$collection]);
        } catch (\Exception $e) {
            return $this->response->statusFail($e->getMessage());
        }
    }

}
