<?php declare(strict_types=1);

require_once __DIR__ . '/../../../src/Classes/ViewHelpers/SearchViewHelper.php';

use CarpeDiem\Classes\ViewHelpers\SearchViewHelper;
use PHPUnit\Framework\TestCase;

class SearchViewHelperTest extends TestCase
{
    public function testdisplaySearchInput_givenString_returnsString() {
        $str = htmlentities('testdata');

        $expected = '<form action="index.php" method="post">';
        $expected .= '<input type="text" name="search" placeholder="Search the collection here" id="search" value="testdata">';
        $expected .= '<button>Search</button>';
        $expected .= '</form>';

        $result = SearchViewHelper::setPostToSearchInput($str);

        $this->assertEquals($expected, $result);
    }
}