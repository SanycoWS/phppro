<?php

interface SenderInterface
{

    public function __construct(
        string $recipient,
        string $from
    );

    public function setMessage(string $message): void;

    public function makeSend(): void;
}

class SendByEmail implements SenderInterface
{

    public function setRecipient(string $recipient): void
    {
        // TODO: Implement setRecipient() method.
    }

    public function setFrom(string $from): void
    {
        // TODO: Implement setFrom() method.
    }

    public function setMessage(string $message): void
    {
        // TODO: Implement setMessage() method.
    }

    public function makeSend(): void
    {
        // TODO: Implement makeSend() method.
    }
}

class SendBySlack implements SenderInterface
{

    public function setRecipient(string $recipient): void
    {
        // TODO: Implement setRecipient() method.
    }

    public function setFrom(string $from): void
    {
        // TODO: Implement setFrom() method.
    }

    public function setMessage(string $message): void
    {
        // TODO: Implement setMessage() method.
    }

    public function makeSend(): void
    {
        // TODO: Implement makeSend() method.
    }
}

class Sender
{
    public function __construct(
        protected SenderInterface $sender
    ) {
    }

    public function send(): bool
    {
        $this->sender->makeSend();

        return true;
    }
}

$emailSender = new SendByEmail();
$emailSender->setFrom('admin');
$emailSender->setRecipient('admin');
$emailSender->setMessage('my test message');

$sender = new Sender($emailSender);
$sender->send();
