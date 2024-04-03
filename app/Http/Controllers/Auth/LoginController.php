<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        try {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $user = Auth::user();
                $success['token'] = $user->createToken('auth')->accessToken;
                $success['user'] = $user;

                return $this->sendResponse($success, 'User login successfully');
            }

            return $this->sendError('Unauthorised', ['error' => 'Unauthorised'], 401);
        } catch (\Throwable $th) {
            return $this->sendError('Internal Server Error', ['error' => $th->getMessage()], 500);
        }
    }
    public function logout(Request $request)
    {
        try {
            $request->user()->token()->revoke();
            return response()->json('Logout');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
