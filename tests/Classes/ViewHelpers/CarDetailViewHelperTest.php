<?php declare(strict_types=1);

namespace CarpeDiem\Tests\Classes\ViewHelpers;

require_once  __DIR__ .'/../../../src/Classes/ViewHelpers/CarDetailViewHelper.php';
require_once __DIR__  . '/../../../src/Classes/Entities/Car.php';

use CarpeDiem\Classes\Entities\Car;
use CarpeDiem\Classes\ViewHelpers\CarDetailViewHelper;
use PHPUnit\Framework\TestCase;

class CarDetailViewHelperTest extends TestCase
{
    public function testShowDetails_ReturnsCorrectCarString_GivenValidCar()
    {
        $carDetailViewHelper = new CarDetailViewHelper();
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
            ->method('getYear')
            ->willReturn(2000);

        $car->expects($this->once())
            ->method('getColour')
            ->willReturn('pink');

        $car->expects($this->once())
            ->method('getLocation')
            ->willReturn('Brazil');

        $result = $carDetailViewHelper->showDetails($car);
        $expected = '<div class="detail-container">'
            . '<div class="imgGrid">'
            . '<img src="documents/images/background.jpg" class="bg-black" alt="black background">'
            . '<img src="documents/images/image1.png" class="bg-car" alt=" Car image">'
            . '</div>'
            . '<div>'
            . '<div class="info-container">'
            . '<div class="make-model">'
            . '<h2>Model</h2>'
            . '<h3 class="text-1">Make: Ford</h3>'
            . '<h3 class="text-2">Model: Reno</h3>'
            . '</div>'
            . '<div class="year-colour">'
            . '<h2>Info</h2>'
            . '<h3 class="text-1">Year: 2000</h3>'
            . '<h3 class="text-2">Colour: pink</h3>'
            . '</div>'
            . '<div class="location">'
            . '<h2>Location</h2>'
            . '<h3 class="text-1">Brazil</h3>'
            . '</div>'
            . '</div>'
            . '</div>';

        $this->assertEquals($expected, $result);
    }

    public function testShowDetails_ThrowsException_GivenInvalidType()
    {
        $carDetailViewHelper = new CarDetailViewHelper();
        $this->expectException(\TypeError::class);
        $carDetailViewHelper->showDetails(-1);
    }
}