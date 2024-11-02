<?php

namespace App\Http\Controllers\Admin\v1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\ForgetPasswordRequest;
use App\Jobs\SendMail;
use App\Models\Admin;

class ForgetPasswordController extends Controller {

    /**
     * @param ForgetPasswordRequest $request
     * @return \App\Http\Response\Response
     * send forget password email using SendEmail job
     */
    public function forgetPassword(ForgetPasswordRequest $request)
    {
        $email = $request->get('email');

        $admin = Admin::where(['email' => $email])->first();

        if(!$admin)
            return $this->response->statusFail( 'Admin Not Found');

        return $this->sendRestPasswordEmail($admin);
    }



    public function sendRestPasswordEmail($admin){
        $reset_password = rand(0000,999999);
        $admin->reset_password = $reset_password;
        $admin->save();
        $email_data = ['view'=> "emails.reset_password", 'email_to'=> $admin->email, 'subject' => 'Reset Password',
            'data' => ["reset_password" => $reset_password]];
        dispatch(new SendMail($email_data));
        return $this->response->statusOk('Email sent with reset password code');
    }


}
