<?php

namespace CarpeDiem\Classes\Hydrators;

use CarpeDiem\Classes\Entities\Car;

class CarHydrator
{

    public static function hydrateFromArray($carArray, $car): Car
    {

        $car->setId($carArray['id']);
        $car->setMake($carArray['makes']);
        $car->setModel($carArray['model']);
        $car->setYear($carArray['year']);
        $car->setColour($carArray['colours']);
        $car->setLocation($carArray['locations']);
        $car->setImage($carArray['image']);

        return $car;
    }
}