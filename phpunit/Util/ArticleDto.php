<?php
namespace phpunit\Gap\Dto\Util;

class ArticleDto extends \Gap\Dto\DtoBase
{
    public $code;
    public $created;
    public $changed;

    public function init(): void
    {
        $this->code = new \Gap\Dto\Bin();
        $this->created = new \Gap\Dto\DateTime();
        $this->changed = new \Gap\Dto\DateTime();
    }
}
