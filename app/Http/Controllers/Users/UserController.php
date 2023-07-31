<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserLoginRequest;
use App\Http\Resources\UserResource;
use App\Services\Users\Login\LoginDTO;
use App\Services\Users\Login\LoginService;

class UserController extends Controller
{

    public function __construct(
        protected LoginService $loginService
    ) {
    }

    public function login(UserLoginRequest $request)
    {
        $data = $request->validated();

        $loginDTO = new LoginDTO(...$data);
        $user = $this->loginService->handle($loginDTO);
        $userResource = new UserResource($user->getUser());

        $token = $user->getToken();

        return $userResource->additional([
            'Bearer' => $token,
        ]);
//
//        $user = $userLoginService->login($data);
//        if (is_null($user) === true) {
//            return 'email or password incorrect';
//        }
//        $token = $userLoginService->getToken();
//
//        $userResource = new UserResource($user);
//
//        return $userResource->additional([
//            'Bearer' => $token,
//        ]);
    }

}
