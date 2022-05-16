<?php

namespace CarpeDiem\Classes\Hydrators;

class CarHydrator
{

    public static function hydrateFromArray($carArray)
    {
        $car = new Car();

        $car->setId($carArray['id']);
        $car->setId($carArray['make']);
        $car->setId($carArray['model']);
        $car->setId($carArray['year']);
        $car->setId($carArray['colour']);
        $car->setId($carArray['location']);
        $car->setId($carArray['image']);

        return $car;
    }
}