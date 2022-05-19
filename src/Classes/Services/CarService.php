<?php

namespace CarpeDiem\Classes\Services;
use CarpeDiem\Classes\DataAccess\CarCollectionDAO;
use CarpeDiem\Classes\DataAccess\CarDAO;
use CarpeDiem\Classes\Entities\CarCollection;
use CarpeDiem\Classes\Entities\MakesCollection;
use CarpeDiem\Classes\DataAccess\MakeColDAO;
use CarpeDiem\Classes\Entities\Car;

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

    public function getCarMakes(): MakesCollection
    {
        $makesDAOArray = MakeColDAO::fetchAllMakes($this->db);

        $makesArray =[];

        foreach ($makesDAOArray as $make){
            $makesArray[] = $make['make'];
        }

        $makesCollection = new MakesCollection();
        $makesCollection->setMakes($makesArray);

        return $makesCollection;
    }

    public function getCar(int $carId): Car
    {
        return CarDAO::fetchCar($this->db, $carId);
    }
}