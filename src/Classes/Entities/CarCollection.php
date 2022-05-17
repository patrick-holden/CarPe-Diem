<?php

namespace CarpeDiem\Classes\Entities;

class CarCollection
{
    private array $cars = [];

    /**
     * @return array
     */
    public function getCars(): array
    {
        return $this->cars;
    }

    public function setCollectedCars(array $collectedCars): void
    {
        $this->cars = $collectedCars;
    }


}