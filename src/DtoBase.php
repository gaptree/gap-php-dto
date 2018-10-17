<?php
namespace Gap\Dto;

abstract class DtoBase implements \JsonSerializable, LoadInterface
{
    public function __construct(array $data = [])
    {
        $this->init();
        $this->load($data);
    }

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }

    public function getData(): array
    {
        return get_object_vars($this);
    }

    public function __set(string $key, $val): void
    {
        if ($flagPos = strpos($key, '_')) {
            $subKey = substr($key, $flagPos + 1);

            $dtoName = substr($key, 0, $flagPos);
            if ($this->$dtoName) {
                $this->$dtoName->$subKey = $val;
                return;
            }

            // deprecated
            $getDtoFun = 'get' . $dtoName;
            if ($dto = $this->$getDtoFun()) {
                $dto->$subKey = $val;
                return;
            }
        }

        throw new \OutOfBoundsException('Cannot find ' . $key . ' in ' . static::class);
    }

    public function load($data = []): void
    {
        if (!is_array($data)) {
            throw new \Exception('require array');
        }

        foreach ($data as $key => $val) {
            if (property_exists($this, $key) &&
                $this->$key instanceof LoadInterface
            ) {
                $this->$key->load($val);
                continue;
            }

            $this->$key = $val;
        }
    }

    protected function init(): void
    {
    }
}
