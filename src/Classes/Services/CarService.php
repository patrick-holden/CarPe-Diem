<?php

namespace CarpeDiem\Classes\Services;
use CarpeDiem\Classes\DataAccess\CarCollectionDAO;
use CarpeDiem\Classes\Entities\Car;
use CarpeDiem\Classes\Entities\CarCollection;

class CarService
{
    private Database $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function getCarCollection(): CarCollection
    {
        return CarCollectionDAO::fetchAllCars($this->db);
    }

    public function getCar(int $carId): Car
    {
        return CarCollectionDAO::fetchCar($this->db, $carId);
    }
}