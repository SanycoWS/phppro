<?php

namespace App\Console\Commands;

use App\Services\GetMyIp\GetMyIpService;
use Illuminate\Console\Command;

class GetMyIp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-my-ip';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(GetMyIpService $service)
    {
        for ($i = 0; $i < 20; $i++) {
            $start = microtime(true);
            $this->info($service->handle());
            $this->info('time: ' . (microtime(true) - $start));
            sleep(2);
        }
    }

}
