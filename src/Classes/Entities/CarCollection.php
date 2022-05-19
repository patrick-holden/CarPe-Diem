<?php

namespace CarpeDiem\Classes\Entities;

class CarCollection
{
    private array $cars = [];

    /**
     * @return array
     */
    public function getCars(string $carMakeName): array
    {
        if (!$carMakeName) {
            return $this->cars;
        }

        $filteredCars = [];

        foreach ($this->cars as $car) {
            if ($car->getMake() == $carMakeName) {
                $filteredCars[] = $car;
            }
        }
        return $filteredCars;
    }

    public function setCollectedCars(array $collectedCars): void
    {
        $this->cars = $collectedCars;
    }
}