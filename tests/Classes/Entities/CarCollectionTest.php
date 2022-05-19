<?php declare(strict_types=1);

require_once __DIR__ . '/../../../src/Classes/Entities/Car.php';
require_once __DIR__ . '/../../../src/Classes/Entities/CarCollection.php';

use CarpeDiem\Classes\Entities\Car;
use PHPUnit\Framework\TestCase;
use CarpeDiem\Classes\Entities\CarCollection;

class CarCollectionTest extends TestCase
{
    public function testGetCarsWithSingleCar_returnsValidArray_GivenValidFilterArray()
    {
        $car = $this->createMock(Car::class);

        $car->expects($this->once())
            ->method('getMake')
            ->willReturn('Suzuki');

        $car->expects($this->once())
            ->method('getColour')
            ->willReturn('Pink');

        $carCollection = new CarCollection([$car]);

        $filteredCars = [$car];

        $isFilter = [
            'make' => 'Suzuki',
            'colour' => 'Pink',
        ];

        $result = $carCollection->getCars($isFilter);

        $this->assertEquals($filteredCars, $result);
    }
}
