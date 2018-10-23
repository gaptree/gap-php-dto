<?php
function m4sHex(): string
{
    $timeHex = dechex(intval(microtime(true) * 10 ** 4));
    return str_pad($timeHex, 12, '0', STR_PAD_LEFT);
}

function m4sBin(): string
{
    $bin = hex2bin(m4sHex());
    if ($bin === false) {
        throw new \Exception('hex to bin failed');
    }
    return $bin;
}

function n100sHex(): string
{
    $offset = 12219292800;
    $n100s = intval((microtime(true) + $offset) * (10 ** 7));

    $version = '1'; // 4-bit
    $timeHex = $version. dechex($n100s);
    return $timeHex;
}

function n100sBin(): string
{
    $bin = hex2bin(n100sHex());
    if ($bin === false) {
        throw new \Exception('hex to bin failed');
    }
    return $bin;
}
