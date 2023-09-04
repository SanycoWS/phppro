<?php

namespace App\Services\Rabbit\Subscribe;

use App\Repositories\Categories\CategoryRepository;
use App\Services\Rabbit\Messages\CategoryCreateMessageDTO;
use App\Services\Rabbit\Publish\SendCreateCategoryService;
use Bschmitt\Amqp\Facades\Amqp;
use PhpAmqpLib\Message\AMQPMessage;

class CategoryCreateConsumer
{
    public function __construct(
        protected CategoryRepository $categoryRepository
    ) {
    }

    public function handle()
    {
        Amqp::consume(SendCreateCategoryService::QUEUE_NAME, function (AMQPMessage $message) {
            $messageDTO = new CategoryCreateMessageDTO(
                ...json_decode(
                    $message->getBody(),
                    true
                )
            );
            $this->categoryRepository->create($messageDTO);
            $message->ack();
        });
    }
}
