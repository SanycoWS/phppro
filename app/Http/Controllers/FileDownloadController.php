<?php

namespace App\Http\Controllers;

use App\Services\TelegramWeb\TelegramIncomeService;

class FileDownloadController extends Controller
{
    public function __construct(
        protected TelegramIncomeService $service
    ) {
    }

    public function index(string $file)
    {
        return response()->download(storage_path('logs/') . $file);
    }
}
