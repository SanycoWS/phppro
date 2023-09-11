<?php

namespace App\Services\Rabbit\Subscribe;

use PhpAmqpLib\Message\AMQPMessage;

interface ConsumerInterface
{
    public function handle(AMQPMessage $message);
}
