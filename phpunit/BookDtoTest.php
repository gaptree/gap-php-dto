<?php
namespace phpunit\Gap\Dto;

use PHPUnit\Framework\TestCase;

class BookDtoTest extends TestCase
{
    public function testAuthor(): void
    {
        $authorUserId = bin2hex(random_bytes(16));

        $book = new BookDto([
            'author_userId' => $authorUserId
        ]);

        $this->assertEquals($authorUserId, $book->author->userId);
    }
}
