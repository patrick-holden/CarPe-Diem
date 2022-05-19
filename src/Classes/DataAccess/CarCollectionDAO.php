<?php

namespace CarpeDiem\Classes\DataAccess;

use CarpeDiem\Classes\Entities\Car;
use CarpeDiem\Classes\Entities\CarCollection;
use CarpeDiem\Classes\Hydrators\CarCollectionHydrator;
use CarpeDiem\Classes\Hydrators\CarHydrator;
use CarpeDiem\Classes\Services\Database;

class CarCollectionDAO
{
    public static function fetchAllCars(Database $db, string $searchTerm = ''): CarCollection
    {
        $searchTerm = '%' . $searchTerm . '%';
        $sql = 'SELECT `cars`.`id`, `makes`.`make`, `model`, `year`, `colours`.`colour`, `locations`.`location`, `image`'
            . 'FROM `cars` '
            . 'INNER JOIN `makes`'
            . 'ON `cars`. `make` = `makes` .`id`'
            . 'INNER JOIN `colours`'
            . 'ON `cars`. `colour` = `colours` .`id`'
            . 'INNER JOIN `locations`'
            . 'ON `cars`. `location` = `locations` .`id`'
            . "WHERE `makes`.`make` LIKE ? "
            . "OR `cars`.`model` LIKE ? "
            . "OR `cars`.`year` LIKE ? "
            . "OR `colours`.`colour` LIKE ? "
            . "OR `locations`.`location` LIKE ? "
            . 'ORDER BY `makes`.`make`, `cars`.`model` ASC';

        $values = [$searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm];
        $stmt = $db->getConnection()->prepare($sql);
        $stmt->execute($values);

        return CarCollectionHydrator::hydrateFromDb($stmt);
    }
}
