<?php

namespace CryptoLabs\Algoritms\XorAlg;

use function cli\line;
use function CryptoLabs\Main\input;
use function CryptoLabs\Main\keyInput;
use function CryptoLabs\Main\method;
use function CryptoLabs\Main\output;
use function CryptoLabs\Main\textInput;

function getRepeatKey(string $text, int $lenth)
{
    $r = $text;

    while (strlen($r) < $lenth) {
        $r .= $r;
    }

    return mb_substr($r, 0, $lenth);
}

function xorOperation(int $key, string $text)
{
    $res = '';
    $currentKey = getRepeatKey($key, strlen($text));
    $arrCurrentKey = mb_str_split($currentKey, 1, "UTF-8");
    $arrText = preg_split('//u', $text, -1, PREG_SPLIT_NO_EMPTY);

    for ($i = 0; $i < count($arrText); $i++) {
        $tmp = $arrCurrentKey[$i] ^ mb_ord($arrText[$i], "UTF-8");
        $res .= chr($tmp);
    }

    echo $res . PHP_EOL;
    output("\\cypher2.txt", $res);
}

function cryptoXor()
{
    setlocale(LC_ALL, "");

    $method = method();

    switch ($method) {
        case '1':
            xorOperation(keyInput(), textInput());
            break;

        case '2':
            xorOperation(keyInput(), input("\\cypher2.txt"));
            break;

        default:
            line('Некорректне введення. Повторіть спробу.');
            cryptoXor();
            break;
    }
}
