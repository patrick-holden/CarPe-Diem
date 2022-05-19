<?php

namespace CarpeDiem\Classes\ViewHelpers;

class CarViewHelper
{
    public static function showCollection(array $showCollection): string
    {
        $carStr = '';
        if (!$showCollection) {
            $carStr = 'Sorry no cars to display';
        } else {

            foreach ($showCollection as $car) {
                $carId = $car->getId();
                $carStr .= '<div class="imgGrid">'
                    . '<img src="documents/images/background.jpg" class="carBlack" alt="black background">'
                    . '<img src="documents/images/' . $car->getImage() . '" class="carImg" alt=" Car image">'
                    . '<div class="details">'
                    . '<h3 class="make">' . $car->getMake() . '</h3>'
                    . '<h3 class="model">' . $car->getModel() . '</h3>'
                    . '</div>'
                    . '<form method="post" action="cardetail.php">'
                    . '<button name="carId" type="submit" class="moreBtn" value="' . $carId . '">See More</button>'
                    . '</form>'
                    . '</div>';
            }
        }
        
        return $carStr;
    }
}