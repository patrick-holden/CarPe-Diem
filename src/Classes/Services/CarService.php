<?php

namespace CarpeDiem\Classes\Services;
use CarpeDiem\Classes\DataAccess\CarCollectionDAO;
use CarpeDiem\Classes\DataAccess\CarDAO;
use CarpeDiem\Classes\DataAccess\ColourColDAO;
use CarpeDiem\Classes\Entities\CarCollection;
use CarpeDiem\Classes\Entities\ColoursCollection;
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

    public function getCarCollection(string $searchTerm = ''): CarCollection
    {
        return CarCollectionDAO::fetchAllCars($this->db, $searchTerm);
    }

    public function getCarMakes(): MakesCollection
    {
        $makesDAOArray = MakeColDAO::fetchAllMakes($this->db);

        $makesArray =[];


        foreach ($makesDAOArray as $make) {
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
  
    public function getCarColours(): ColoursCollection
    {
        $coloursDAOArray = ColourColDAO::fetchAllColours($this->db);

        $coloursArray =[];

        foreach ($coloursDAOArray as $colour){
            $coloursArray[] = $colour['colour'];
        }

        $coloursCollection = new ColoursCollection();
        $coloursCollection->setColours($coloursArray);

        return $coloursCollection;
    }
}

