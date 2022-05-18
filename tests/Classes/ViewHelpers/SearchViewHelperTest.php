<?php declare(strict_types=1);

require_once '../../../src/Classes/ViewHelpers/SearchViewHelper.php';

use CarpeDiem\Classes\ViewHelpers\SearchViewHelper;
use PHPUnit\Framework\TestCase;
class SearchViewHelperTest extends TestCase
{
    public function testdisplaySearchInput_givenString_returnsString() {
        $str = 'testdata';

        $expected = '<form action="index.php" method="post">';
        $expected .= '<label for="search">Search:</label>';
        $expected .= '<input type="text" name="search" id="search" value="testdata">';
        $expected .= '<button>Search</button>';
        $expected .= '</form>';

        $result = SearchViewHelper::displaySearchInput($str);

        $this->assertEquals($expected, $result);
    }
}