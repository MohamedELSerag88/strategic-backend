<?php

namespace App\Http\Controllers\Admin\V1;

use App\Http\Controllers\Controller;
use App\Models\Consultation;
use App\Models\DiscussionForum;
use App\Models\Event;
use App\Models\EventRequest;
use App\Models\Expert;
use App\Models\Membership;
use App\Models\News;
use App\Models\OpinionMeasurement;
use App\Models\Study;
use App\Models\User;
use App\Models\ConsultationRequest;
class DashboardController extends Controller
{


    public function dashboard(){
        $data =[
            "event_count" => Event::count(),
            "event_request_count" => EventRequest::count(),
            "users_count" => User::count(),
            "studies_count" => Study::count(),
            "membership_count" => Membership::count(),
            "consultation_count" => Consultation::count(),
            "consultation_request_count" => ConsultationRequest::count(),
            "expert_count" => Expert::count(),
            "forum_count" => DiscussionForum::count(),
            "news_count" => News::count(),
            "opinion_count" => OpinionMeasurement::count(),
        ];
        return $this->response->statusOk(["data" =>$data]);
    }
}
