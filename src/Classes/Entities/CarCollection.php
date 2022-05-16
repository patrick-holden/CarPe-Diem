<?php

namespace CarpeDiem\Classes\Entities;

class CarCollection
{
    private array $cars = [];

    public function getCollectedCars(): array
    {
        return $this->cars;
    }

    public function setCollectedCars(array $collectedCars): void
    {
        $this->cars = $collectedCars;
    }
}