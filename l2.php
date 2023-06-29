<?php

class Shape
{
    protected int $width;
    protected int $height;

    public function setWidth(int $width): Shape
    {
        $this->width = $width;

        return $this;
    }

    public function setHeight(int $height): Shape
    {
        $this->height = $height;

        return $this;
    }

    public function getArea(): int
    {
        return $this->height * $this->width;
    }
}

class Rectangle extends Shape
{

}

class Square extends Shape
{

    public function setWidth(int $width): Shape
    {
        $this->height = $width;

        return parent::setWidth($width);
    }

    public function setHeight(int $height): Shape
    {
        $this->width = $height;

        return parent::setHeight($height);
    }
}

function printArea(Shape $shape): void
{
    $shape->setWidth(5);
    $shape->setHeight(10);
    var_dump($shape->getArea());
}

printArea(new Rectangle());
printArea(new Square());
