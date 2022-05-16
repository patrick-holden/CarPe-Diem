<?php

require_once 'src/Classes/Services/Database.php';

// access json with curl and create an array called $cars
$curl = curl_init('https://dev.io-academy.uk/resources/cars/data.json');

curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$output = curl_exec($curl);

curl_close($curl);

$cars = json_decode($output, JSON_PRETTY_PRINT);

// Go through $cars array and create new arrays with all of the makes, locations and colours.
$allMakes = [];
$allColours = [];
$allLocations = [];

foreach ($cars as $car) {
    $allMakes[] = $car['make'];
    $allColours[] = $car['color'];
    $allLocations[] = $car['location'];
}

// Remove duplicates from each array.
$makes = array_values(array_unique($allMakes));
$colours = array_values(array_unique($allColours));
$locations = array_values(array_unique($allLocations));

$makeKey = array_keys($makes);


function dropTablesIfExist(Database $db): bool
{

    $tableNames = ['cars', 'makes', 'colours', 'locations'];

    foreach ($tableNames as $tableName) {
        $sql = "DROP TABLE IF EXISTS `$tableName`; ";

        $query = $db->getConnection()->prepare($sql);

        $query->execute();
    }

    return true;

}


// Create empty tables
function createTables(Database $db, string $tableName): bool
{
    $sql = "CREATE TABLE `$tableName` ("
        . '`id` int(11) unsigned NOT NULL AUTO_INCREMENT,'
        . "`$tableName` varchar(255) DEFAULT NULL,"
        . 'PRIMARY KEY (`id`)'
        . ') ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;';

    $query = $db->getConnection()->prepare($sql);

    return $query->execute();
}

function createMainTable(Database $db, array $data): bool
{
    $sql = 'CREATE TABLE `cars` ('
        . '`id` int(11) unsigned NOT NULL AUTO_INCREMENT,'
        . '`make` int(11) unsigned DEFAULT NULL,'
        . '`model` varchar(255) DEFAULT NULL,'
        . '`year` int(11) DEFAULT NULL,'
        . '`colour` int(11) unsigned DEFAULT NULL,'
        . '`location` int(11) unsigned DEFAULT NULL,'
        . '`image` varchar(255) DEFAULT NULL,'
        . 'PRIMARY KEY (`id`),'
        . 'CONSTRAINT `fk_cars_make` FOREIGN KEY (`make`) REFERENCES `makes` (`id`),'
        . 'CONSTRAINT `fk_cars_location` FOREIGN KEY (`location`) REFERENCES `locations` (`id`),'
        . 'CONSTRAINT `fk_cars_colour` FOREIGN KEY (`colour`) REFERENCES `colours` (`id`)'
        . ') ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;';

    $query = $db->getConnection()->prepare($sql);

    $query->execute();

    foreach ($data as $car) {
        $sql = "INSERT INTO `cars` (`make`, `model`, `year`, `colour`, `location`, `image`)"
            . " VALUES (:make, :model, :year, :colour, :location, :image); ";

        if($car['make'] == $makes) {

        }

        $values = [':make' => $car['make'],
            ':model' => $car['model'],
            ':year' => $car['year'],
            ':colour' => $car['color'],
            ':location' => $car['location'],
            ':image' => $car['image']
        ];

        $query = $db->getConnection()->prepare($sql);

        $query->execute($values);
    }

    return true;

}


// Fill tables
function fillTables(Database $db, string $tableName, array $data): bool
{
    foreach ($data as $dt) {
        $sql = "INSERT INTO `$tableName` (`$tableName`) VALUES (:data); ";

        $values = [':data' => $dt];

        $query = $db->getConnection()->prepare($sql);

        $query->execute($values);
    }

    return true;
}

$db = Database::getInstance();

dropTablesIfExist($db);

createTables($db, 'makes');
createTables($db, 'colours');
createTables($db, 'locations');

createMainTable($db, $cars);

//fillTables($db, 'makes', $makes);
//fillTables($db, 'locations', $locations);
//fillTables($db, 'colours', $colours);

//createForeignKeys($db);


echo '<h1>Database successfully initialised!</h1>';
