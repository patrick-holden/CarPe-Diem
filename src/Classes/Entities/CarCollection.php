<?php

namespace CarpeDiem\Classes\Entities;

class CarCollection
{
    private array $cars = [];

    /**
     * @param array $cars
     */
    public function __construct(array $cars)
    {
        $this->cars = $cars;
    }


    public function getCars(array $isFilter): array
    {
        if (!$isFilter['make'] && !$isFilter['colour']) {
            return $this->cars;
        }

        $filteredCars = [];

        if ($isFilter['make'] && !$isFilter['colour']) {
            foreach ($this->cars as $car) {
                if ($car->getMake() == $isFilter['make']) {
                    $filteredCars[] = $car;
                }
            }
        }

        if (!$isFilter['make'] && $isFilter['colour']) {
            foreach ($this->cars as $car) {
                if ($car->getColour() == $isFilter['colour']) {
                    $filteredCars[] = $car;
                }
            }
        }

        if ($isFilter['make'] && $isFilter['colour']) {
            foreach ($this->cars as $car) {
                if ($car->getColour() == $isFilter['colour'] && $car->getMake() == $isFilter['make']) {
                    $filteredCars[] = $car;
                }
            }
        }

        return $filteredCars;
    }

    public function setCollectedCars(array $collectedCars): void
    {
        $this->cars = $collectedCars;
    }
}