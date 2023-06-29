<?php

interface DbManager
{
    // робота з БД
    public function connect();

    public function select(): array;
}

class CMysql implements DbManager
{
    public function connect()
    {
    }

    public function select(): array
    {
        return [];
    }
}

class PgSql implements DbManager
{
    public function connect()
    {
    }

    public function select(): array
    {
        return [];
    }
}

class UserRepository
{
    public function __construct(
        protected DbManager $dbManager,
    ) {
    }

    public function getAll()
    {
        return $this->dbManager->select();
    }
}

$userRepository = new UserRepository(new CMysql());
