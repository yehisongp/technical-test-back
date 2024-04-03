<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    public function __construct(
        protected UserRepository $userRepository
    ) {
    }
    public function register(RegisterRequest $request): JsonResponse
    {
        try {
            $user = new User([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ]);

            $user = $this->userRepository->save($user);

            $success['token'] = $user->createToken('auth')->accessToken;
            $success['user'] = $user;

            return $this->sendResponse($success, 'User register successfully');
        } catch (\Throwable $th) {
            return $this->sendError('Internal Server Error', ['error' => $th->getMessage()], 500);
        }
    }
}
