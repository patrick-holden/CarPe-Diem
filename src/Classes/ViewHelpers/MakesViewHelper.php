<?php

namespace CarpeDiem\Classes\ViewHelpers;

class MakesViewHelper
{
    public static function allMakesDropDown(array $makesList): string
    {
        $dropDown = '<label for="makes">Filter by Car</label>';
        $dropDown .= '<select name="makes" id="makes">';

        $list = '<option value=""></option>';

        foreach ($makesList as $make){
            $list .= '<option value="' . $make .'">' . $make . '</option>';
        }

        $dropDown .= $list;
        $dropDown .= '</select>';

        return $dropDown;
    }
}