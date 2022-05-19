<?php

require 'vendor/autoload.php';

use CarpeDiem\Classes\Services\CarService;
use CarpeDiem\Classes\ViewHelpers\CarDetailViewHelper;

$carId = $_POST['carId'];
$carService = new CarService();
$car = $carService->getCar($carId);

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/styleDetail.css">
    <title>CarPe-Diem Detail</title>
</head>

<body>
<header class="header-container">
    <form action="index.php">
        <button class="backBtn">
            <<
        </button>
    </form>
    <h1>CarPe-Diem | Car Collection</h1>
</header>
<main>
    <?php
    echo CarDetailViewHelper::showDetails($car);
    ?>
</main>
</body>
</html>
