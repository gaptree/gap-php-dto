<?php
namespace Gap\Dto;

class Json implements \JsonSerializable, LoadInterface
{
    private $json;

    public function __construct(string $json = '')
    {
        if ($json) {
            $this->load($json);
        }
    }

    public function setByArr(array $arr): void
    {
        $this->json = json_encode($arr);
        if ($this->json === false) {
            throw new \Exception('json encode failed');
        }
    }

    public function setByJson(string $json): void
    {
        $this->json = $json;
    }

    public function load($val): void
    {
        $this->setByArr($val);
    }

    public function getJson(): string
    {
        return $this->json;
    }

    public function getArr(): array
    {
        $res = json_decode($this->json, true);
        if ($res === null) {
            throw new \Exception('json decode failed');
        }
        return $res;
    }

    public function getObj(): object
    {
        $res = json_decode($this->json);
        if ($res === null) {
            throw new \Exception('json decode failed');
        }
        return $res;
    }

    public function __toString(): string
    {
        return $this->getJson();
    }

    public function jsonSerialize(): string
    {
        return $this->__toString();
    }
}
