<?php

namespace App\Console\Commands;

use App\Services\Proxy\WebShareService;
use Illuminate\Console\Command;

class ProxyTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:proxy-test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(WebShareService $service)
    {
        $service->getProxyList();
    }
}
