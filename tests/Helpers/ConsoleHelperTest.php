<?php

namespace Slides\Saml2\Tests;

use PHPUnit\Framework\TestCase;
use Slides\Saml2\Helpers\ConsoleHelper;

class ConsoleHelperTest extends TestCase
{
    public function testStringToArray()
    {
        $this->assertSame([], ConsoleHelper::stringToArray(''));
        $this->assertSame([], ConsoleHelper::stringToArray(null));

        $this->assertSame(
            ['item1' => 'value1', 'item2' => 'value2'],
            ConsoleHelper::stringToArray('item1:value1,item2:value2')
        );

        $this->assertSame(
            ['item1' => 'value1', 'item2' => 'value 2'],
            ConsoleHelper::stringToArray(' item1 :value1 , item2 :value 2')
        );

        $this->assertSame(
            ['value1', 'value2', 'value3'],
            ConsoleHelper::stringToArray('value1,value2,value3')
        );
    }
}