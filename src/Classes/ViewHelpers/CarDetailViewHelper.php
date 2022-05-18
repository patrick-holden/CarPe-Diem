<?php

namespace CarpeDiem\Classes\ViewHelpers;

use CarpeDiem\Classes\Entities\Car;

class CarDetailViewHelper
{
    public static function showDetails(Car $car): string
    {
        $carDetailStr = '<div class="detail-container">'
                            . '<div class="imgGrid">'
                                . '<img src="documents/images/background.jpg" class="bg-black" alt="black background">'
                                . '<img src=documents/images/' . $car->getImage() . ' class="bg-car" alt=" Car image">'
                            . '</div>'
                            . '<div>'
                            . '<div class="info-container">'
                                . '<div class="make-model">'
                                    . '<h2>Model</h2>'
                                    . '<h3 class="text-1">Make: ' . $car->getMake() . '</h3>'
                                    . '<h3 class="text-2">Model: ' . $car->getModel() . '</h3>'
                                . '</div>'
                                . '<div class="year-colour">'
                                    . '<h2>Info</h2>'
                                    . '<h3 class="text-1">Year: ' . $car->getYear() . '</h3>'
                                    . '<h3 class="text-2">Colour: ' . $car->getColour() . '</h3>'
                                . '</div>'
                                . '<div class="location">'
                                    . '<h2>Location</h2>'
                                    . '<h3 class="text-1">' . $car->getLocation() . '</h3>'
                                . '</div>'
                            . '</div>'
                        . '</div>';
        return $carDetailStr;
    }

}