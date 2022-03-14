<?php

namespace CryptoLabs\Algoritms\XorAlg;

use function CryptoLabs\Languages\alphabet;
use function cli\line;
use function cli\prompt;

function output(string $text)
{
    $fileName = '\\cypher2.txt';
    $filePath = __DIR__ . '/../output/';

    file_put_contents(realpath($filePath) . $fileName, $text, LOCK_EX);
}

function input()
{
    $fileName = '\\cypher2.txt';
    $filePath = __DIR__ . '/../output/';
    return file_get_contents($filePath . $fileName);
}

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
    output($res);
}

function cryptoXor()
{
    setlocale(LC_ALL, "");

    $method = prompt("Виберіть програму роботи:\n1) Шифрування\n2) Дешифрування\nВведіть цифру зі списку");

    switch ($method) {
        case '1':
            $key = (int)readline("Введіть ключ шифрування: ");
            
            $text = (string)readline('Введіть текст для шифрування: ');

            xorOperation($key, $text);
            break;

        case '2':
            $key = readline("Введіть ключ шифрування: ");

            xorOperation($key, input());
            break;

        default:
            line('Некорректне введення. Повторіть спробу.');
            cryptoXor();
            break;
    }
}
