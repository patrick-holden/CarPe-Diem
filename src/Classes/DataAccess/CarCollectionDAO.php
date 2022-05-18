<?php

namespace CarpeDiem\Classes\DataAccess;

use CarpeDiem\Classes\Entities\CarCollection;
use CarpeDiem\Classes\Hydrators\CarCollectionHydrator;
use CarpeDiem\Classes\Services\Database;

class CarCollectionDAO
{
    public static function fetchAllCars(Database $db, string $searchTerm = ''): CarCollection
    {
        $sql = 'SELECT `cars`.`id`, `makes`.`make`, `model`, `year`, `colours`.`colour`, `locations`.`location`, `image`'
            . 'FROM `cars` '
            . 'INNER JOIN `makes`'
            . 'ON `cars`. `make` = `makes` .`id`'
            . 'INNER JOIN `colours`'
            . 'ON `cars`. `colour` = `colours` .`id`'
            . 'INNER JOIN `locations`'
            . 'ON `cars`. `location` = `locations` .`id`'
                . "WHERE `makes`.`make` LIKE '%$searchTerm%'"
                . "OR `cars`.`model` LIKE '%$searchTerm%'"
                . "OR `cars`.`year` LIKE '%$searchTerm%'"
                . "OR `colours`.`colour` LIKE '%$searchTerm%'"
                . "OR `locations`.`location` LIKE '%$searchTerm%'"
                . 'ORDER BY `makes`.`make`, `cars`.`model` ASC';

        $stmt = $db->getConnection()->prepare($sql);
        $stmt->execute();

        return CarCollectionHydrator::hydrateFromDb($stmt);
    }
}