<?php

namespace App\Services\Rabbit\Publish;

use App\Services\Rabbit\Messages\CategoryCreateMessageDTO;
use Bschmitt\Amqp\Facades\Amqp;

class SendCreateCategoryService
{

    public const QUEUE_NAME = 'create_category';

    public function handle()
    {
        $message = new CategoryCreateMessageDTO(
            'new_category' . rand(1, 999),
            time(),
            time(),
        );
        Amqp::publish(self::QUEUE_NAME, json_encode($message), [
            'queue' => self::QUEUE_NAME
        ]);
    }
}
