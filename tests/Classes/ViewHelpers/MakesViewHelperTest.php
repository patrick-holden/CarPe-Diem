<?php

require_once __DIR__ . '/../../../src/Classes/ViewHelpers/MakesViewHelper.php';

use PHPUnit\Framework\TestCase;
use CarpeDiem\Classes\ViewHelpers\MakesViewHelper;

class MakesViewHelperTest extends TestCase
{
    public function testMakesViewHelper_returnsValidHTML_GivenValidArray()
    {
        $makesList = ['Ford', 'BMW'];

        $expected = '<label for="makes">Filter by Car</label>';
        $expected .= '<select name="makes" id="makes">';

        $list = '<option value=""></option>';

        foreach ($makesList as $make) {
            $list .= '<option value="' . $make . '">' . $make . '</option>';
        }

        $expected .= $list;
        $expected .= '</select>';

        $result = MakesViewHelper::allMakesDropDown($makesList);


        $this->assertEquals($expected, $result);
    }

    public function testMakesViewHelper_returnsError_GivenInteger()
    {
        $integer = 1;

        $this->expectException(TypeError::class);

        MakesViewHelper::allMakesDropDown($integer);
    }
    
}