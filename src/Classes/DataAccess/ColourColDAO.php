<?php

namespace CarpeDiem\Classes\DataAccess;

use CarpeDiem\Classes\Services\Database;

class MakeColDAO
{
    public static function fetchAllColours(Database $db): array
    {
        $sql = 'SELECT `colour`'
            . 'FROM `colours`'
            . 'ORDER BY `colour`;';

        $query = $db->getConnection()->prepare($sql);

        $query->execute();

        $query->setFetchMode(\PDO::FETCH_ASSOC);

        return $query->fetchAll();
    }
}