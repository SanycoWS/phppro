<?php

class Test implements JsonSerializable
{
    public function __construct(
        protected string $data,
        protected int $year,
        private int $month,
    ) {
    }

    public function jsonSerialize(): array
    {
        $result = get_object_vars($this);

        return $result;
    }
}

$test = new Test('secret key)', 2020, 12);

$reflect = new ReflectionClass($test);

var_dump($reflect->getProperties());

