<?php

namespace CarpeDiem\Classes\Hydrators;

use CarpeDiem\Classes\Entities\Car;
use CarpeDiem\Classes\Entities\CarCollection;

class CarCollectionHydrator
{
    public static function hydrateFromDb(\PDOStatement $stmt): CarCollection
    {
        $stmt->setFetchMode(\PDO::FETCH_ASSOC);

        $result = $stmt->fetchAll();

        $carCollection = new CarCollection();

        if ($result) {
            $collectedCars = [];
            foreach ($result as $carArray) {
                $car = new Car();
                $car = CarHydrator::hydrateFromArray($carArray, $car);
                $collectedCars[] = $car;
            }
            $carCollection->setCollectedCars($collectedCars);

        }
        
        return $carCollection;
    }
}