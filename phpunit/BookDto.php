<?php
namespace phpunit\Gap\Dto;

class BookDto extends \Gap\Dto\DtoBase
{
    public $author;
    public $title;

    protected function init(): void
    {
        $this->author = new UserDto();
    }
}
