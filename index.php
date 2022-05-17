<?php
namespace CarpeDiem;

require 'vendor/autoload.php';

use CarpeDiem\Classes\Services\CarService;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>A title</title>
</head>

<p>
    <?php $carCollection = new CarService();
    $carCollectionResult = $carCollection->getCarCollection(1);
    echo '<pre>';
    print_r($carCollectionResult);
    echo '</pre>';?>


</html>
