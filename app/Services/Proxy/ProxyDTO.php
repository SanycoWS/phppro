<?php

namespace App\Services\Proxy;

class ProxyDTO implements \JsonSerializable
{
    public function __construct(
        protected string $username,
        protected string $password,
        protected string $ip,
        protected int $port,
    ) {
    }

    public function getData(): string
    {
        return 'http://' . $this->username . ':' . $this->password . '@' . $this->getIp() . ':' . $this->getPort();
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getIp(): string
    {
        return $this->ip;
    }

    public function getPort(): int
    {
        return $this->port;
    }

    public function jsonSerialize(): array
    {
        return [
            'ip' => $this->ip,
            'port' => $this->port,
            'password' => $this->password,
            'username' => $this->username,
        ];
    }
}
