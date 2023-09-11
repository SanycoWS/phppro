<?php

namespace App\Services\Rabbit\Subscribe;

use App\Enums\Queues;
use Bschmitt\Amqp\Facades\Amqp;
use PhpAmqpLib\Message\AMQPMessage;

class AmqpConsumeService
{

    protected const QUEUE_CONSUMER = [
        Queues::CREATE_CATEGORY->value => ExampleConsumer::class,
        Queues::CREATE_CATEGORY2->value => ExampleConsumer::class,
    ];

    public function __construct(
        protected Amqp $amqp
    ) {
    }

    public function handle(Queues $queue)
    {
        $consumer = app()->make(self::QUEUE_CONSUMER[$queue->value]);
        $this->amqp->consume($queue, function (AMQPMessage $message) use ($consumer) {
            try {
                $consumer->handle($message);
            } catch (\Exception $exception) {
                $exception->getMessage();
                // ToDo check $message and $exception
                $message->ack();
            }
        });
    }
}
