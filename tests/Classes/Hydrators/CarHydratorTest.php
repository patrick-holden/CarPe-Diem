<?php declare(strict_types=1);

require_once '../../../src/Classes/Hydrators/CarHydrator.php';
require_once '../../../src/Classes/Entities/Car.php';

use CarpeDiem\Classes\Entities\Car;
use CarpeDiem\Classes\Hydrators\CarHydrator;
use PHPUnit\Framework\TestCase;

class CarHydratorTest extends TestCase
{
    public function testHydrateFromArray_returnsValidObject_GivenValidArray()
    {
        $car = $this->createMock(Car::class);
        $carArray = [
            'id' => 1,
            'make' => 'Ford',
            'model' => 'mondeo',
            'year' => 1972,
            'colour' => 'red',
            'location' => 'rome',
            'image' => 'image1.png'
        ];

        $car->expects($this->once())
            ->method('setId');

        $car->expects($this->once())
            ->method('setMake');

        $car->expects($this->once())
            ->method('setModel');

        $car->expects($this->once())
            ->method('setYear');

        $car->expects($this->once())
            ->method('setColour');

        $car->expects($this->once())
            ->method('setLocation');

        $car->expects($this->once())
            ->method('setImage');

        $result = CarHydrator::hydrateFromArray($carArray, $car);

        $this->assertEquals($car, $result);
    }
}
