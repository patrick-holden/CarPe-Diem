<?php

namespace CarpeDiem\Classes\Hydrators;

use CarpeDiem\Classes\Entities\Car;

class CarHydrator
{
    public static function hydrateFromArray($carArray, $car): Car
    {
        $car->setId($carArray['id']);
        $car->setMake($carArray['make']);
        $car->setModel($carArray['model']);
        $car->setYear($carArray['year']);
        $car->setColour($carArray['colour']);
        $car->setLocation($carArray['location']);
        $car->setImage($carArray['image']);

        return $car;
    }

    public static function hydrateFromDb(\PDOStatement $stmt): Car
    {
        $stmt->setFetchMode(\PDO::FETCH_CLASS, Car::class);

        $car = $stmt->fetch();

        if (!$car) {
            return new Car();
        }

        return $car;
    }
}