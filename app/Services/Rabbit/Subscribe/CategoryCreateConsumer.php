<?php

namespace App\Services\Rabbit\Subscribe;

use App\Services\Rabbit\Publish\SendCreateCategoryService;
use Bschmitt\Amqp\Facades\Amqp;
use PhpAmqpLib\Message\AMQPMessage;

class CategoryCreateConsumer
{
    public function __construct(
        protected ExampleConsumer $consumer
    ) {
    }

    public function handle()
    {
        Amqp::consume(SendCreateCategoryService::QUEUE_NAME, function (AMQPMessage $message) {
            $this->consumer->handle($message);
        });
    }
}
