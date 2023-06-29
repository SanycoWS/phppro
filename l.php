<?php

class Transport
{
    public function startEngine(): void
    {
        // Transport startEngine
    }
}

class Car extends Transport
{
    public function startEngine(): void
    {
        parent::startEngine();
        // Car startEngine
    }
}

