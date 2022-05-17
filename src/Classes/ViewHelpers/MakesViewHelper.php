<?php

namespace CarpeDiem\Classes\ViewHelpers;

use CarpeDiem\Classes\Entities\MakesCollection;

class MakesViewHelper
{
    public static function allMakesDropDown(array $makesList): string
    {
        $dropDown = '<form action="index.php" method="post">';
        $dropDown .= '<label for="makes">Filter by Car</label>';
        $dropDown .= '<select name="makes" id="makes">';

        $list = '<option value=""></option>';

        foreach ($makesList as $make){
            $list .= '<option value="' . $make .'">' . $make . '</option>';
        }

        $dropDown .= $list;

        $dropDown .= '</select>';

        $dropDown .= '<button>Filter</button>';

        $dropDown .='</form>';

        return $dropDown;
    }
}