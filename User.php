<?php

class Shape
{
    protected string $name;
    protected ?int $use;
    protected int $color = 0;

    public function incrementUse(int $count = 1): static
    {
        $this->use += $count;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    public function calculateArea(): float
    {
        return 0;
    }

    public function getUse(): ?int
    {
        return $this->use;
    }

    /**
     * @param int $use
     * @return Shape
     */
    public function setUse(int $use): Shape
    {
        $this->use = $use;

        return $this;
    }

    /**
     * @return int
     */
    public function getColor(): int
    {
        return $this->color;
    }

    /**
     * @param int $color
     * @return Shape
     */
    public function setColor(int $color): Shape
    {
        $this->color = $color;

        return $this;
    }

}

class Circle extends Shape
{
    public function __construct(
        protected string $name,
        protected float $radius
    ) {
    }

    public function calculateArea(): float
    {
        return pi() * pow($this->radius, 2);
    }
}

class Square extends Shape
{
    public function __construct(
        protected string $name,
        protected float $width,
        protected float $height,
    ) {
    }

    public function calculateArea(): float
    {
        return $this->width * $this->height;
    }
}

class Square2 extends Shape
{
    public function __construct(
        protected string $name,
    ) {
    }
}

$c = new Square('square', 4, 6);
$cArea = ($c->calculateArea());
$cName = ($c->getName());

$circle = new Circle('circle 111', 4);
$cArea = ($circle->calculateArea());
$c1Name = ($circle->getName());

$c->setUse(5)->setColor(6)->getUse();
var_dump($circle->getUse());
$circle->incrementUse()->incrementUse(2)->incrementUse(3)->incrementUse();
var_dump($circle->getUse());
