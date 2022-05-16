<?php

namespace CarpeDiem\Classes\DataAccess;
use CarpeDiem\Classes\Entities\CarCollection;
use CarpeDiem\Classes\Hydrators\CarCollectionHydrator;
use CarpeDiem\Classes\Services\Database;

class CarCollectionDAO
{
    public static function fetch(Database $db, int $id): CarCollection
    {
        $sql = 'SELECT `id`, `make`, `model`, `year`, `colour`, `location`, `image`'
            . 'FROM `car` '
            . 'WHERE `id` = :id ';

        $values = [':id' => $id];

        $stmt = $db->getConnection()->prepare($sql);
        $stmt->execute($values);

        return CarCollectionHydrator::hydrateFromDb($stmt);
    }
}