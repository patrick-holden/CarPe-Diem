<?php

namespace CarpeDiem\Classes\ViewHelpers;

class SearchViewHelper
{
    public static function setPostToSearchInput(string $lastSearch): string
    {
        $searchFunc = '<form action="index.php" method="post">';
        $searchFunc .= '<label for="search">Search:</label>';
        $searchFunc .= '<input type="text" name="search" id="search" value="' . htmlentities($lastSearch) .'">';
        $searchFunc .= '<button>Search</button>';
        $searchFunc .='</form>';

        return $searchFunc;
    }
    public static function clearSearch(): string
    {
        $clearSearch = '<form action="index.php" method="post">';
        $clearSearch .= '<button name="search" value="">Clear search</button>';

        return $clearSearch;
    }

}