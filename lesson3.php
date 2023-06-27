<?php

class AdminUser
{

    public const STATUS = 'active';

    public static int $age = 10;

    public function __construct(
        protected string $name
    ) {
    }

    public function create(): array
    {
        return [
            'role' => self::getRole(),
            'name' => $this->getName(),
        ];
    }

    public static function getRole(): string
    {
        return 'admin';
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

}

$user = new AdminUser('test admin user');
$user2 = new AdminUser('test 222');
var_dump($user->create());
var_dump($user2->create());

var_dump(AdminUser::getRole());
var_dump(AdminUser::STATUS);
