<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserLoginRequest;
use App\Http\Resources\UserResource;
use App\Services\Users\UserLoginService;

class UserController extends Controller
{

    public function login(UserLoginRequest $request, UserLoginService $userLoginService)
    {
        $data = $request->validated();

        $user = $userLoginService->login($data);
        if (is_null($user) === true) {
            return 'email or password incorrect';
        }
        $token = $userLoginService->getToken();

        $userResource = new UserResource($user);

        return $userResource->additional([
            'Bearer' => $token,
        ]);
    }

}
