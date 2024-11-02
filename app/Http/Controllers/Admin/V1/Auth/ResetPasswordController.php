<?php

namespace App\Http\Controllers\Admin\v1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\RestPasswordRequest;
use App\Http\Resources\Admin\Auth\LoginResource;
use App\Models\Admin;

class ResetPasswordController extends Controller {

    /**
     * @param RestPasswordRequest $request
     * @return \App\Http\Response\Response
     * update admin password using code sent to admin email
     */
    public function resetPassword(RestPasswordRequest $request){
        $data = $request->only(['reset_password', 'new_password', 'new_password_confirmation']);


        $admin = Admin::where(['reset_password' =>$data['reset_password']])->first();

        if(!$admin)
            return $this->response->statusFail( 'Wrong reset password code');

        $admin->password = \Hash::make($data['new_password']);
        $admin->reset_password = null;
        $admin->save();
        return $this->response->statusOk('Password changed successfully');
    }

}
