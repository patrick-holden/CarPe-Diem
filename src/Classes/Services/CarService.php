<?php

namespace CarpeDiem\Classes\Services;
use CarpeDiem\Classes\DataAccess\CarCollectionDAO;
use CarpeDiem\Classes\Entities\CarCollection;

class CarService
{
    private Database $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function getCarCollection(int $id): CarCollection
    {
        return CarCollectionDAO::fetchAllCars($this->db, $id);
    }
}