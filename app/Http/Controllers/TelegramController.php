<?php

namespace App\Http\Controllers;

use App\Services\TelegramWeb\IncomeDTO;
use App\Services\TelegramWeb\TelegramIncomeService;
use Illuminate\Http\Request;

class TelegramController extends Controller
{
    public function __construct(
        protected TelegramIncomeService $service
    ) {
    }

    public function index(Request $request)
    {
        $data = new IncomeDTO($request->all());
        $this->service->handle($data);

        return 'TestController->index';
    }
}
