<?php

namespace App\Http\Controllers\User\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\ConsultationRequestRequest;
use App\Http\Requests\User\MembershipRequest;
use App\Http\Resources\User\MembershipResource;
use App\Models\ConsultationRequest;
use App\Models\Membership;

class ConsultationRequestController extends Controller
{


    /**
     * Store a newly created resource in storage.
     */
    public function store(ConsultationRequestRequest $request)
    {
        $data = $request->validated();
        $consultationRequest = ConsultationRequest::create($data);
        return $this->response->statusOk(trans("messages.ConsultationRequest_created_successfully"));

    }



}
