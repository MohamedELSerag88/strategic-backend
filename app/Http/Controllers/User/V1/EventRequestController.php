<?php

namespace App\Http\Controllers\User\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\ConsultationRequestRequest;
use App\Http\Requests\User\EventRequestRequest;
use App\Http\Requests\User\MembershipRequest;
use App\Http\Resources\User\MembershipResource;
use App\Models\ConsultationRequest;
use App\Models\Membership;

class EventRequestController extends Controller
{


    /**
     * Store a newly created resource in storage.
     */
    public function store(EventRequestRequest $request)
    {
        $data = $request->validated();
        $consultationRequest = \App\Models\EventRequest::create($data);
        return $this->response->statusOk(trans("messages.event_created_successfully"));

    }

}
