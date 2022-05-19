<?php

namespace CarpeDiem\Classes\ViewHelpers;

use CarpeDiem\Classes\Entities\MakesCollection;

class ColoursViewHelper
{
    public static function allColoursDropDown(array $coloursList): string
    {
        $dropDown = '<label for="colours">Filter by Colour</label>';
        $dropDown .= '<select name="colours" id="colours">';

        $list = '<option value=""></option>';

        foreach ($coloursList as $colour) {
            $list .= '<option value="' . $colour .'">' . $colour . '</option>';
        }

        $dropDown .= $list;
        $dropDown .= '</select>';

        return $dropDown;
    }
}