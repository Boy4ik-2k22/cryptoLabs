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

function methodXor(int $key, string $text, array $languages, string $type = 'encode')
{
    $res = '';
    $text = mb_str_split($text, 1, "UTF-8");



    echo $res . PHP_EOL;
    output($res);
}

function cryptoXor()
{
    setlocale(LC_ALL, "");

    echo "Доступні мови:\n1) Українська\n\t" . implode("\n\t", alphabet('ua'));
    echo "\n2) Російська\n\t" . implode("\n\t", alphabet('ru'));
    echo "\n3) Англійська\n\t" . implode("\n\t", alphabet('en')) . "\n";

    $langChoise = prompt("Виберіть цифрою мову кодування");

    switch ($langChoise) {
        case '1':
            $lang = alphabet('ua');
            break;

        case '2':
            $lang = alphabet('ru');
            break;

        case '3':
            $lang = alphabet('en');
            break;

        default:
            line('Некорректне введення. Повторіть спробу.');
            cryptoXor();
            break;
    }

    $method = prompt("Виберіть програму роботи:\n1) Шифрування\n2) Дешифрування\nВведіть цифру зі списку");

    switch ($method) {
        case '1':
            do {
                $key = prompt("Введіть ключ шифрування");
            } while ($key < 1 && $key >= mb_strlen($lang[0]) && is_numeric($key));

            $text = readline('Введіть текст для шифрування: ');

            methodXor($key, $text, $lang);
            break;

        case '2':
            do {
                $key = prompt("Введіть ключ шифрування");
            } while ($key < 1 && $key >= mb_strlen($lang[0]) && is_numeric($key));

            methodXor($key, input(), $lang, 'decode');
            break;

        default:
            line('Некорректне введення. Повторіть спробу.');
            cryptoXor();
            break;
    }
}
