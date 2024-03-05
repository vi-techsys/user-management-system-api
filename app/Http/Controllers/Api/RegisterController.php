<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Auth;

class RegisterController extends BaseController
{
    /**
     * Register endpoint
     *
     * @return \Illuminate\Http\Response
     */

     public function register(RegisterRequest $request)
     {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        //use should login to get token
        //$response['token'] = $user->createToken('user-management-system-api')->accessToken;
        $response['user'] = $user;
        return $this->sendResponse($response,'Account created. You can now login',201);
     }

      /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $data = $request->validate(['email'=>['email','required','string'],
                                    'password'=>['required','string']]);
        if(Auth::attempt(['email' => $data['email'], 'password' => $data['password']])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('user-management-system-api')->accessToken; 
            return $this->sendResponse($success, 'User login successfully.');
        } 
            return $this->sendError('Login failed.', ['error'=>'Invalid credentials'],401);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return $this->sendError('Logout.', ['error'=>'User log out']);
    }
}
