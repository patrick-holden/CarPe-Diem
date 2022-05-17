<?php

namespace CarpeDiem\Classes\Services;
use CarpeDiem\Classes\DataAccess\CarCollectionDAO;
use CarpeDiem\Classes\Entities\CarCollection;
use CarpeDiem\Classes\Entities\MakesCollection;
use CarpeDiem\Classes\DataAccess\MakeColDAO;

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
            array_push($makesArray, $make['make']);
        }

        $makesCollection = new MakesCollection();
        $makesCollection->setMakes($makesArray);

        return $makesCollection;
    }
}