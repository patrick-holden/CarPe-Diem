<?php

require_once __DIR__ . '/../../../src/Classes/ViewHelpers/MakesViewHelper.php';

use PHPUnit\Framework\TestCase;
use CarpeDiem\Classes\ViewHelpers\MakesViewHelper;

class MakesViewHelperTest extends TestCase
{
    public function testMakesViewHelper_returnsValidHTML_GivenValidArray()
    {
        $coloursList = ['pink', 'red'];

        $expected = '<label for="colours">Filter by Colour</label>';
        $expected .= '<select name="colours" id="colours">';
        $list = '<option value=""></option>';

        foreach ($coloursList as $colour){
            $list .= '<option value="' . $colour .'">' . $colour . '</option>';
        }

        $expected .= $list;
        $expected .= '</select>';

        $result = ColoursViewHelper::allColoursDropDown($coloursList);


        $this->assertEquals($expected, $result);

    }

}