<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SwaggerGenerateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'swagger:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $openapi = \OpenApi\Generator::scan(['app/Http']);

        file_put_contents(
            public_path() . 'swagger.json',
            $openapi->toJson()
        );
    }
}
