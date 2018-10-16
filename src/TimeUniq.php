<?php
namespace Gap\Dto;

/**
 * {timeLow:32bits}-
 * {timeMid:16bits}-
 * {version:4bits}{timeHi:12bits}-
 * {variant:1-3bits}{clockSeq:13-15bits}-
 * {node:48bits}
 *
 * Version
 *  1. Time-based with unique or random host identifier
 *  2. DCE Security version (with POSIX UIDs)
 *  3. Name-based (MD5 hash)
 *  4. Random
 *  5. Name-based (SHA-1 hash)
 *
 * Variant:
 *  0  : reserverd
 *  10 : RFC4122
 *  110: Microsoft
 *  111: Futrue
 */
class TimeUniq implements \JsonSerializable
{
    private $bin;

    public function __construct(string $input = '')
    {
        if ($input) {
            $len = strlen($input);
            if ($len === 8) {
                $this->bin = $input;
            } elseif ($len === 18) {
                $this->bin = $this->toBin($input);
            }
        }
    }

    public function __toString(): string
    {
        return $this->getStr();
    }

    public function jsonSerialize(): string
    {
        return $this->__toString();
    }

    public function getBin(): string
    {
        if ($this->bin) {
            return $this->bin;
        }

        $n100s = $this->getN100s();
        $version = '1'; // 4-bit
        $timeHex = $version . dechex($n100s);
        $timeBin = hex2bin($timeHex);
        if ($timeBin === false) {
            throw new \Exception('hex2bin failed');
        }

        $this->bin = $timeBin;
        return $this->bin;
    }

    public function getStr(): string
    {
        $bin = $this->getBin();
        return $this->toStr($bin);
    }

    public function toStr(string $bin)
    {
        // todo verify bin
        return implode(
            '-',
            [
                bin2hex(substr($bin, 4)),
                bin2hex(substr($bin, 2, 2)),
                bin2hex(substr($bin, 0, 2))
            ]
        );
    }

    public function toBin(string $str): string
    {
        // todo verify $str
        $arr = explode('-', $str);
        if (!isset($arr[2])) {
            return new \Exception('to bin failed');
        }
        return hex2bin($arr[2]) . hex2bin($arr[1]) . hex2bin($arr[0]);
    }

    private function getN100s(): int
    {
        $offset = 12219292800;
        $n100s = intval((microtime(true) + $offset) * (10 ** 7));
        return $n100s;
    }
}
