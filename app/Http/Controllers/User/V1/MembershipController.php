<?php

namespace App\Http\Controllers\User\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\MembershipRequest;
use App\Http\Resources\User\MembershipResource;
use App\Models\Membership;

class MembershipController extends Controller
{


    /**
     * Store a newly created resource in storage.
     */
    public function store(MembershipRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth('user')->id();
        $check = Membership::where('user_id' ,auth('user')->id())->first();
        if(!empty($check)){
            return $this->response->statusOk(trans("messages.Membership_exist"));
        }
        $membership = Membership::create($data);
        return $this->response->statusOk(trans("messages.Membership_created_successfully"));

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $membership = Membership::where('user_id' ,auth('user')->id())->first();
        if(!$membership){
            return $this->response->statusFail(trans("messages.membership_not_found"));
        }

        return $this->response->statusOk(["data" => new MembershipResource($membership)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MembershipRequest $request, $id)
    {
        $data = $request->validated();
        $membership = Membership::where('id' ,$id)->first();
        if(!$membership){
            return $this->response->statusFail(trans("messages.membership_not_found"));
        }
        Membership::where('id' ,$id)->update($data);
        return $this->response->statusOk(trans("messages.Membership_created_successfully"));
    }


}
