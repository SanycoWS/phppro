<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use OpenApi\Attributes as OA;

#[OA\Info(version: "0.1", title: "My First API")]
#[OA\Server(url: 'http://192.168.56.56:85/api')]
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
