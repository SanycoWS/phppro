<?php

class User
{
    public function create(int $userId, array $data)
    {
        // створюємо користувача в бд
    }

    public function update(int $userId, array $data)
    {
        // оновлюємо користувача в бд
    }

    public function sendEmail(int $userId, string $message)
    {
        // send email
    }
    // some else...
}

class UserData
{
    public function __construct(
        protected int $id,
        protected string $name,
        protected string $email,
    ) {
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

}

class EmailSender
{
    public function sendEmail(UserData $userData, string $message): string
    {
        return 'send email to:' . $userData->getEmail() . ' with message:' . $message;
        // send email
    }
}

class UserUpdateRepository
{
    public function update(UserData $userData)
    {
        // update users set name = $userData->getName() where id = $userData->getId();
    }
}

$user1 = new UserData(1, 'Ivan', 'example@gmail.com');
$user2 = new UserData(2, 'Anna', 'anna@gmail.com');
$email = new EmailSender();
echo $email->sendEmail($user1, 'test message');
echo PHP_EOL;
echo $email->sendEmail($user2, 'test message');
