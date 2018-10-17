<?php
namespace Gap\Dto;

class Bin implements \JsonSerializable, LoadInterface
{
    private $bin;

    public function __construct(string $bin)
    {
        $this->load($bin);
    }

    public function setByHex(string $hex): void
    {
        $this->bin = hex2bin($hex);
    }

    public function setByBin(string $bin): void
    {
        $this->bin = $bin;
    }

    public function load($val): void
    {
        $this->bin = $val;
    }

    public function getBin(): string
    {
        return $this->bin;
    }

    public function getHex(): string
    {
        return bin2hex($this->bin);
    }

    public function __toString(): string
    {
        return $this->getHex();
    }

    public function jsonSerialize(): string
    {
        return $this->__toString();
    }
}
