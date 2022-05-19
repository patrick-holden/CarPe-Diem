<?php

namespace CarpeDiem\Classes\ViewHelpers;

class SearchViewHelper
{
    public static function setPostToSearchInput(string $lastSearch): string
    {
        $searchFunc = '<form action="index.php" method="post">';
        $searchFunc .= '<input type="text" name="search" placeholder="Search the collection here" id="search" value="' . htmlentities($lastSearch) .'">';
        $searchFunc .= '<button>Search</button>';
        $searchFunc .='</form>';

        return $searchFunc;
    }
}
