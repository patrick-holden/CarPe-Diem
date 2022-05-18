<?php

namespace CarpeDiem\Classes\ViewHelpers;

class CarViewHelper
{
    public static function showCollection(array $showCollection): string
    {
        $carStr ='';
        foreach ($showCollection as $car) {
            $carStr .= '<div class="imgGrid">'
                . '<img src="documents/images/background.jpg" class="carBlack" alt="black background">'
                . '<img src=documents/images/' . $car->getImage() . ' class="carImg" alt=" Car image">'
                . '<div class="details">'
                . '<h3 class="make">' . $car->getMake() . '</h3>'
                . '<h3 class="model">' . $car->getModel() . '</h3>'
                . '</div>'
                . '<button class="moreBtn">See More</button>'
                . '</div>'; }
        return $carStr;
    }
}