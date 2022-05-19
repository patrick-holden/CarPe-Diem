<?php

namespace CarpeDiem\Classes\DataAccess;
use CarpeDiem\Classes\Entities\Car;
use CarpeDiem\Classes\Hydrators\CarHydrator;
use CarpeDiem\Classes\Services\Database;

class CarDAO
{
    public static function fetchCar(Database $db, int $carId): Car
    {
        $sql = 'SELECT `cars`.`id`, `makes`.`make`, `model`, `year`, `colours`.`colour`, `locations`.`location`, `image`'
            . 'FROM `cars` '
            . 'LEFT JOIN `makes`'
            . 'ON `cars`. `make` = `makes` .`id`'
            . 'LEFT JOIN `colours`'
            . 'ON `cars`. `colour` = `colours` .`id`'
            . 'LEFT JOIN `locations`'
            . 'ON `cars`. `location` = `locations` .`id`'
            . 'WHERE `cars`.`id` = :carId';

        $value = ['carId' => $carId];

        $stmt = $db->getConnection()->prepare($sql);
        $stmt->execute($value);

        return CarHydrator::hydrateFromDb($stmt);
    }
}