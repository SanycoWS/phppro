<?php

namespace App\Services\Rabbit\Subscribe;

use App\Services\Books\BookStoreByMessageService;
use App\Services\Rabbit\Messages\CategoryCreateMessageDTO;
use PhpAmqpLib\Message\AMQPMessage;

class ExampleConsumer implements ConsumerInterface
{

    public function __construct(
        protected BookStoreByMessageService $bookStoreByMessageService
    ) {
    }

    public function handle(AMQPMessage $message)
    {
        $messageDTO = new CategoryCreateMessageDTO(
            ...json_decode(
                $message->getBody(),
                true
            )
        );

        $this->bookStoreByMessageService->handle($messageDTO);

        $message->ack();
    }
}
