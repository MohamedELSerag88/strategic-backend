<?php

namespace App\Http\Controllers\Admin\v1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\LoginRequest;
use App\Http\Resources\Admin\Auth\LoginResource;
use App\Models\Admin;

class LoginController extends Controller {


    /**
     * @param LoginRequest $request
     * @return \App\Http\Response\Response
     * Login function using email and password and return jwt token
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->only(['email', 'password']);



        $admin = Admin::where(['email' =>$credentials['email']])->first();

        if(!$admin)
            return $this->response->statusFail( 'Admin not found');


        if (! $token = auth('admin')->login($admin)) {
            return $this->response->statusFail(['message' => 'Wrong Credentials']);
        }
        $admin->token = $token;
        $data = ['data' => new LoginResource($admin), "message" =>'Admin founded successfully'];
        return $this->response->statusOk($data);
    }


}
