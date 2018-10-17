<?php
namespace Gap\Dto;

class DateTime extends \DateTime implements \JsonSerializable, LoadInterface
{
    public function load($timeStr): void
    {
        $this->modify($timeStr);
    }

    public function __toString(): string
    {
        return $this->format('Y-m-d H:i:s.u');
    }

    public function jsonSerialize(): string
    {
        return $this->__toString();
    }
}
