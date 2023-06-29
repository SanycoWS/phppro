<?php

interface TransportEngine
{
    public function start(): bool;

    public function stop(): bool;
}

interface TransportDoors
{
    public function openDoor(): bool;

    public function closeDoor(): bool;
}

interface TransportOverload
{
    public function start(): bool;

    public function stop(): bool;

    public function openDoor(): bool;

    public function closeDoor(): bool;
}

abstract class NewCar
{

}

class Car extends NewCar implements TransportEngine, TransportDoors
{

    public function start(): bool
    {
        // TODO: Implement start() method.
    }

    public function stop(): bool
    {
        // TODO: Implement stop() method.
    }

    public function openDoor(): bool
    {
        // TODO: Implement openDoor() method.
    }

    public function closeDoor(): bool
    {
        // TODO: Implement closeDoor() method.
    }
}


