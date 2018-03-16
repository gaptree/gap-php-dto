<?php
namespace phpunit\Gap\Dto;

use PHPUnit\Framework\TestCase;
use Gap\Dto\DateTime;

class DateTimeTest extends TestCase
{
    public function testToString()
    {
        $time = new DateTime('2018-3-6 12:13:14.12345');
        $this->assertEquals(
            '2018-03-06 12:13:14.123450',
            $time
        );
    }
}
