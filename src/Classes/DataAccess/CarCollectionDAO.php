<?php

namespace CarpeDiem\Classes\DataAccess;
use CarpeDiem\Classes\Entities\CarCollection;
use CarpeDiem\Classes\Hydrators\CarCollectionHydrator;
use CarpeDiem\Classes\Services\Database;

class CarCollectionDAO
{
    public static function fetchAllCars(Database $db): CarCollection
    {
        $sql = 'SELECT `car`.`id`, `make`.`make`, `model`, `year`, `colour`.`colour`, `location`.`location`, `image`'
            . 'FROM `car` '
            . 'INNER JOIN `make`'
            .'ON `car`. `make` = `make` .`id`'
            . 'INNER JOIN `colour`'
            .'ON `car`. `colour` = `colour` .`id`'
            . 'INNER JOIN `location`'
            .'ON `car`. `location` = `location` .`id`';
        
        $stmt = $db->getConnection()->prepare($sql);
        $stmt->execute();

        return CarCollectionHydrator::hydrateFromDb($stmt);
    }
}