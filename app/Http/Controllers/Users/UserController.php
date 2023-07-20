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

        if (auth()->attempt($data) === false) {
            return 'email or password incorrect';
        }

        $token = auth()
            ->user()
            ->createToken(config('app.name'));

        $userResource = new UserResource(
            $userLoginService->getById(
                auth()
                    ->user()->id
            )
        );

        return $userResource->additional([
            'Bearer' => $token,
        ]);
    }

}
