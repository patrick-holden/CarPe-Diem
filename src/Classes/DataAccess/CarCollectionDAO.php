<?php

namespace CarpeDiem\Classes\DataAccess;
use CarpeDiem\Classes\Entities\CarCollection;
use CarpeDiem\Classes\Hydrators\CarCollectionHydrator;
use CarpeDiem\Classes\Services\Database;

class CarCollectionDAO
{
    public static function fetchAllCars(Database $db): CarCollection
    {
        $sql = 'SELECT `cars`.`id`, `makes`.`makes`, `model`, `year`, `colours`.`colours`, `locations`.`locations`, `image`'
            . 'FROM `cars` '
            . 'INNER JOIN `makes`'
            .'ON `cars`. `make` = `makes` .`id`'
            . 'INNER JOIN `colours`'
            .'ON `cars`. `colour` = `colours` .`id`'
            . 'INNER JOIN `locations`'
            .'ON `cars`. `location` = `locations` .`id`';
        
        $stmt = $db->getConnection()->prepare($sql);
        $stmt->execute();

        return CarCollectionHydrator::hydrateFromDb($stmt);
    }
}