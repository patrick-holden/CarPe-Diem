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

    public function testGetCarsWithTwoCars_returnsValidArray_GivenValidFilterArray()
    {
        $car1 = $this->createMock(Car::class);
        $car2 = $this->createMock(Car::class);

        $car1->expects($this->any())
            ->method('getMake')
            ->willReturn('Suzuki');

        $car1->expects($this->any())
            ->method('getColour')
            ->willReturn('Pink');

        $car2->expects($this->any())
            ->method('getMake')
            ->willReturn('Maybach');

        $car2->expects($this->any())
            ->method('getColour')
            ->willReturn('Aquamarine');

        $carCollection = new CarCollection([$car1, $car2]);

        $filteredCars = [$car1];

        $isFilter = [
            'make' => 'Suzuki',
            'colour' => 'Pink',
        ];

        $result = $carCollection->getCars($isFilter);

        $this->assertEquals($filteredCars, $result);
    }
}
