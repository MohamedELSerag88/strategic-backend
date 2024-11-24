<?php

namespace App\Http\Controllers\User\V1;

use App\Http\Requests\User\Auth\ForgetPasswordRequest;
use App\Http\Requests\User\Auth\LoginRequest;
use App\Http\Requests\User\Auth\RegisterRequest;
use App\Http\Requests\User\Auth\RestPasswordRequest;
use App\Http\Resources\User\LoginResource;
use App\Jobs\SendMail;
use App\Models\User;
use App\Http\Controllers\Controller;

class AuthController extends Controller {


    public function register(RegisterRequest $request){
        $data = $request->validated();
        $data['password'] = \Hash::make($data['password']);

        User::create($data);
        return $this->response->statusOk(["message" => trans('messages.user_created_successfully')]);
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only(['email', 'password']);

        $user = User::where(['email' =>$credentials['email']])->first();

        if(!$user)
            return $this->response->statusFail(trans('messages.user_not_found'));


        if (! $token = auth('user')->attempt($credentials)) {
            return $this->response->statusFail(['message' => 'Wrong Credentials']);
        }
        $user->token = $token;
        $data = ['data' => new LoginResource($user), "message" => trans('messages.user_founded_successfully')];
        return $this->response->statusOk($data);
    }




    public function forgetPassword(ForgetPasswordRequest $request)
    {
        $email = $request->get('email');

        $user = User::where(['email' => $email])->first();

        return $this->sendRestPasswordEmail($user);
    }



    public function sendRestPasswordEmail($user){
        $reset_password = rand(pow(10, 3), pow(10, 4)-1);
        $user->reset_password = $reset_password;
        $user->save();
        $email_data = ['view'=> "emails.reset_password", 'email_to'=> $user->email, 'subject' => trans('messages.reset_password'),
            'data' => ["reset_password" => $reset_password]];
        dispatch(new SendMail($email_data));
        return $this->response->statusOk(trans('messages.email_sent_with_reset_password_code'));
    }

    public function resetPassword(RestPasswordRequest $request){
        $data = $request->only(['reset_password', 'new_password', 'new_password_confirmation']);


        $user = User::where(['reset_password' =>$data['reset_password']])->first();

        if(!$user)
            return $this->response->statusFail( trans('messages.wrong_reset_password_code'));

        $user->password = \Hash::make($data['new_password']);
        $user->reset_password = null;
        $user->save();
        return $this->response->statusOk(["data" => new LoginResource($user),"message" => trans('messages.password_updated_successfully')]);
    }




}
