<?php
namespace Gap\Dto;

class DateTime extends \DateTime implements \JsonSerializable, LoadInterface
{
    public function load($inVal): void
    {
        $val = ($inVal instanceof \DateTime) ?
            $inVal->format($this->getFormat())
            :
            strval($inVal);

        $this->modify($val);
    }

    public function __toString(): string
    {
        return $this->format($this->getFormat());
    }

    public function jsonSerialize(): string
    {
        return $this->__toString();
    }

    private function getFormat(): string
    {
        return 'Y-m-d H:i:s.u';
    }
}
