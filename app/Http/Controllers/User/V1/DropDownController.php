<?php

namespace App\Http\Controllers\User\V1;

use App\Http\Controllers\Controller;
use App\Http\Filters\ActivePipeline;
use App\Http\Filters\RelationPipeline;
use App\Http\Resources\Admin\DropDownResource;
use App\Models\AppConfig;
use App\Models\Consultation;
use App\Models\DiscussionForum;
use App\Models\Event;
use App\Models\OpinionMeasurement;
use App\Models\Study;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;
use function App\Http\Controllers\Admin\V1\app;
use function App\Http\Controllers\Admin\V1\collect;

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

    public function serviceable()
    {
        try {
            $data= collect([]);
            $events = Event::with("category")->get();
            $data->push($events->transform(function ($item, $key) {
                return [
                    "id" => $item->id,
                    "name" => $item->category->name.' - '.$item->title,
                    "type" => Event::class
                ];
            }));

            $opinionMeasurements = OpinionMeasurement::get();
            $data->push($opinionMeasurements->transform(function ($item, $key) {
                return [
                    "id" => $item->id,
                    "name" => $item->title,
                    "type" => OpinionMeasurement::class
                ];
            }));


            $discussionForum = DiscussionForum::get();
            $data->push($discussionForum->transform(function ($item, $key) {
                return [
                    "id" => $item->id,
                    "name" => $item->title,
                    "type" => DiscussionForum::class
                ];
            }));

            $studies = Study::get();
            $data->push($studies->transform(function ($item, $key) {
                return [
                    "id" => $item->id,
                    "name" => $item->title,
                    "type" => Study::class
                ];
            }));

            $consultations = Consultation::get();
            $data->push($consultations->transform(function ($item, $key) {
                return [
                    "id" => $item->id,
                    "name" => $item->name,
                    "type" => Consultation::class
                ];
            }));
            $flattened = $data->flatten(1);
            $data = $flattened->values();
           return $this->response->statusOk(["data"=>$data]);
        } catch (\Exception $e) {
            return $this->response->statusFail($e->getMessage());
        }
    }

    public function appConfigDropDown(Request $request){
        $keys = explode(",",$request->input("keys"));
        $data = AppConfig::whereIn("key", $keys)->get()->pluck("value","key");
        $data = $data->map(function ($item, $key) {
            return  explode(",",$item);
        });
        return $this->response->statusOk(["data" => $data]);
    }

}
