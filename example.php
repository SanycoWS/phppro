<?php

// Оголошення класу Transport
class Transport {
    protected $name;
    protected $speed;

    public function __construct($name, $speed) {
        $this->name = $name;
        $this->speed = $speed;
    }

    // Геттери та сеттери
    // ...

    public function getInfo() {
        return "Name: {$this->name}, Speed: {$this->speed} km/h";
    }
}

// Оголошення підкласу Car
class Car extends Transport {
    private $numDoors;

    public function __construct($name, $speed, $numDoors) {
        parent::__construct($name, $speed);
        $this->numDoors = $numDoors;
    }

    // Геттери та сеттери
    // ...

    public function startEngine() {
        return "Starting the engine of {$this->name}...";
    }
}

// Оголошення підкласу Bicycle
class Bicycle extends Transport {
    private $numGears;

    public function __construct($name, $speed, $numGears) {
        parent::__construct($name, $speed);
        $this->numGears = $numGears;
    }

    // Геттери та сеттери
    // ...

    public function ringBell() {
        return "Ring the bell on {$this->name}!";
    }
}

// Оголошення підкласу Boat
class Boat extends Transport {
    private $maxPassengers;

    public function __construct($name, $speed, $maxPassengers) {
        parent::__construct($name, $speed);
        $this->maxPassengers = $maxPassengers;
    }

    // Геттери та сеттери
    // ...

    public function sail() {
        return "Sailing with {$this->maxPassengers} passengers on {$this->name}!";
    }
}

// Створення об'єктів
$car = new Car("BMW", 200, 4);
$bicycle = new Bicycle("Trek", 30, 10);
$boat = new Boat("Speedy", 80, 8);

// Виведення інформації про кожен засіб
echo $car->getInfo();      // Виведе: Name: BMW, Speed: 200 km/h
echo $bicycle->getInfo();  // Виведе: Name: Trek, Speed: 30 km/h
echo $boat->getInfo();     // Виведе: Name: Speedy, Speed: 80 km/h

// Виклик специфічних методів
echo $car->startEngine();  // Виведе: Starting the engine of BMW...
echo $bicycle->ringBell(); // Виведе: Ring the bell on Trek!
echo $boat->sail();        // Виведе: Sailing with 8 passengers on Speedy!
