<?php

class Test
{

    public function auth(string $email, string $password): bool
    {
        if ($this->isValidUserData($email, $password) === true) {
            return true;
        }

        return false;
    }

    private function isValidUserData(string $email, string $password): bool
    {
        return $email !== '' && $password !== '';
    }

}

readonly class User
{
    public function __construct(
        private string $name,
        private string $email,
        private string $status,
        private string $age,
    ) {
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

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getAge(): string
    {
        return $this->age;
    }

}
