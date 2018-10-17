<?php
namespace phpunit\Gap\Dto;

use PHPUnit\Framework\TestCase;

class LoadTest extends TestCase
{
    public function testLoad(): void
    {
        $article = new Util\ArticleDto();
        $article->load([
            'code' => 'somecode',
            'created' => '2018-12-12 00:00:00'
        ]);

        $this->assertInstanceOf(
            \Gap\Dto\Bin::class,
            $article->code
        );
        $this->assertEquals(
            '2018-12-12 00:00:00.000000',
            $article->created
        );
        $this->assertEquals(
            bin2hex('somecode'),
            $article->code->getHex()
        );
    }
}
