<?php declare(strict_types=1);

require_once __DIR__ . '/../../../src/Classes/ViewHelpers/SearchViewHelper.php';

use CarpeDiem\Classes\ViewHelpers\SearchViewHelper;
use PHPUnit\Framework\TestCase;
class SearchViewHelperTest extends TestCase
{
    public function testdisplaySearchInput_givenString_returnsString() {
        $str = htmlentities('testdata');

        $expected = '<form action="index.php" method="post">';
        $expected .= '<label for="search">Search:</label>';
        $expected .= '<input type="text" name="search" id="search" value="testdata">';
        $expected .= '<button>Search</button>';
        $expected .= '</form>';

        $result = SearchViewHelper::setPostToSearchInput($str);

        $this->assertEquals($expected, $result);
    }
}