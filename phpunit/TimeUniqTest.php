<?php
namespace phpunit\Gap\Dto;

use PHPUnit\Framework\TestCase;
use Gap\Dto\TimeUniq;

class TimeUniqTest extends TestCase
{
    public function testGetStr(): void
    {
        $uniq = new TimeUniq();
        $str = $uniq->getStr();
        $arr = explode('-', $str);
        $this->assertEquals(
            3,
            count($arr)
        );
        $this->assertEquals(8, strlen($arr[0]));
        $this->assertEquals(4, strlen($arr[1]));
        $this->assertEquals(4, strlen($arr[2]));
    }

    public function testGetBin(): void
    {
        $uniq1 = new TimeUniq();

        $bin = $uniq1->getBin();
        $str = $uniq1->getStr();

        $uniq2 = new TimeUniq($bin);
        $uniq3 = new TimeUniq($str);

        $this->assertEquals(
            $uniq2->getBin(),
            $uniq3->getBin()
        );

        $this->assertEquals(
            $uniq2->getStr(),
            $uniq3->getStr()
        );
    }
}
