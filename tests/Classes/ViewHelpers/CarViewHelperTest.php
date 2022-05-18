<?php

declare(strict_types=1);

namespace CarpeDiem\Tests\Classes\ViewHelpers;

require_once '../../../src/Classes/ViewHelpers/CarViewHelper.php';
require_once '../../../src/Classes/Entities/CarCollection.php';
require_once '../../../src/Classes/Entities/Car.php';

use CarpeDiem\Classes\Entities\Car;
use CarpeDiem\Classes\ViewHelpers\CarViewHelper;
use PHPUnit\Framework\TestCase;

class CarViewHelperTest extends TestCase
{
    public function testShowCollection_ReturnsCorrectCarString_GivenValidArray()
    {
        $carViewHelper = new CarViewHelper();
        $car = $this->createMock(Car::class);
        $car->expects($this->once())
            ->method('getImage')
            ->willReturn('image1.png');
        $car->expects($this->once())
            ->method('getMake')
            ->willReturn('Ford');
        $car->expects($this->once())
            ->method('getModel')
            ->willReturn('Reno');
        $car->expects($this->once())
            ->method('getId')
            ->willReturn(1);

        $result = $carViewHelper->showCollection([$car]);
        $expected = '<div class="imgGrid">'
            . '<img src="documents/images/background.jpg" class="carBlack" alt="black background">'
            . '<img src="documents/images/image1.png" class="carImg" alt=" Car image">'
            . '<div class="details">'
            . '<h3 class="make">Ford</h3>'
            . '<h3 class="model">Reno</h3>'
            . '</div>'
            . '<form method="post" action="cardetail.php">'
            . '<button name="carId" type="submit" class="moreBtn" value="1">See More</button>'
            . '</form>'
            . '</div>';

        $this->assertEquals($expected, $result);
    }

    public function testShowDetails_ThrowsException_GivenInvalidType()
    {
        $carViewHelper = new CarViewHelper();
        $this->expectException(\TypeError::class);
        $result = $carViewHelper->showCollection(-1);
    }
}