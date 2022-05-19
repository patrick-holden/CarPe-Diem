<?php
use CarpeDiem\Classes\Services\Database;
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
$reducedMakes = array_values(array_unique($allMakes));
$reducedColoursWithNull = array_values(array_unique($allColours));
$reducedLocations = array_values(array_unique($allLocations));

$reducedColours = [];
foreach ($reducedColoursWithNull as $reducedColour) {
    if ($reducedColour) {
        $reducedColours[] = $reducedColour;
    }
}

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
    $fieldName = rtrim($tableName, 's');
    $sql = "CREATE TABLE `$tableName` ("
        . '`id` int(11) unsigned NOT NULL AUTO_INCREMENT,'
        . "`$fieldName` varchar(255) DEFAULT NULL,"
        . 'PRIMARY KEY (`id`)'
        . ') ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;';

    $query = $db->getConnection()->prepare($sql);

    return $query->execute();
}

function createMainTable(Database $db): bool
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

    return $query->execute();
}

// Fill tables
function fillMainTable (Database $db, array $cars, array $reducedMakes, array $reducedColours, array $reducedLocations): bool
{
    $makeID = [];
    $colourID = [];
    $locationID = [];

    foreach ($cars as $car) {

        foreach ($reducedMakes as $reducedMake) {
            if ($car['make'] == $reducedMake) {
                $makeID = array_keys($reducedMakes, $reducedMake);
                $makeID[0]++;
            }
        }

        foreach ($reducedColours as $reducedColour) {
            if (!$car['color']) {
                $colourID[0] = null;
            } elseif ($car['color'] == $reducedColour) {
                $colourID = array_keys($reducedColours, $reducedColour);
                $colourID[0]++;
            }
        }

        foreach ($reducedLocations as $reducedLocation) {
            if ($car['location'] == $reducedLocation) {
                $locationID = array_keys($reducedLocations, $reducedLocation);
                $locationID[0]++;
            }
        }

        if (!$car['year']) {
            $car['year'] = null;
        }

        $sql = "INSERT INTO `cars` (`make`, `model`, `year`, `colour`, `location`, `image`)"
            . " VALUES (:make, :model, :year, :colour, :location, :image); ";

        $values = [
            ':make' => $makeID[0],
            ':model' => $car['model'],
            ':year' => $car['year'],
            ':colour' => $colourID[0],
            ':location' => $locationID[0],
            ':image' => $car['image']
        ];

        $query = $db->getConnection()->prepare($sql);

        $query->execute($values);
    }

    return true;
}

function fillTables(Database $db, string $tableName, string $fieldName, array $data): bool
{
    foreach ($data as $dt) {
        $sql = "INSERT INTO `$tableName` (`$fieldName`) VALUES (:data); ";

        $values = [':data' => $dt];

        $query = $db->getConnection()->prepare($sql);
        $success = $query->execute($values);

        if (!$success) {
            return false;
        }
    }

    return true;
}

$db = Database::getInstance();

dropTablesIfExist($db);

createTables($db, 'makes');
createTables($db, 'colours');
createTables($db, 'locations');

fillTables($db, 'makes', 'make', $reducedMakes);
fillTables($db, 'colours', 'colour', $reducedColours);
fillTables($db, 'locations', 'location', $reducedLocations);

createMainTable($db);

$success = fillMainTable($db, $cars, $reducedMakes, $reducedColours, $reducedLocations);

if (!$success) {
    echo '<h1>Database initialisation Unsuccessful!</h1>';
} else {
    echo '<h1>Database successfully initialised!</h1>';
}

