<?php

namespace CarpeDiem\Classes\DataAccess;

use CarpeDiem\Classes\Services\Database;

class MakeColDAO
{
    public static function fetchAllMakes(Database $db): array
    {
        $sql = 'SELECT `make`'
            . 'FROM `makes`'
            . 'ORDER BY `make`;';

        $query = $db->getConnection()->prepare($sql);

        $query->execute();

        $query->setFetchMode(\PDO::FETCH_ASSOC);

        return $query->fetchAll();
    }
}