<?php

namespace CryptoLabs\Algoritms\CezarAlg;

use function CryptoLabs\Languages\alphabet;
use function cli\line;
use function cli\prompt;

function output(string $text)
{
    $fileName = '\\cypher1.txt';
    $filePath = __DIR__ . '/../output/';

    file_put_contents(realpath($filePath) . $fileName, $text, LOCK_EX);
}

function input()
{
    $fileName = '\\cypher1.txt';
    $filePath = __DIR__ . '/../output/';
    return file_get_contents($filePath . $fileName);
}

function encryption(int $key, string $text, array $languages)
{
    $res = '';
    $text = mb_str_split($text, 1, "UTF-8");

    for ($i = 0; $i < count($text); $i++) {
        for ($j = 0; $j < count($languages); $j++) {
            $symbol = mb_str_split($languages[$j], 1, "UTF-8");

            for ($k = 0; $k < count($symbol); $k++) {
                if ($text[$i] === $symbol[$k]) {
                    $tmp = $k + $key;

                    while ($tmp < 0) {
                        $tmp += count($symbol);
                    }
                    while ($tmp >= count($symbol)) {
                        $tmp -= count($symbol);
                    }

                    $res .= $symbol[$tmp];
                }
            }
        }

        if ($text[$i] === ' ') {
            $res .= ' ';
        }
        if ($text[$i] === ',') {
            $res .= ',';
        }
        if ($text[$i] === '.') {
            $res .= '.';
        }
        if ($text[$i] === '-') {
            $res .= '-';
        }
    }

    echo $res . PHP_EOL;
    output($res);
}

function decryption(int $key, array $languages)
{
    $res = '';
    $text = input();
    $text = mb_str_split($text, 1, "UTF-8");

    for ($i = 0; $i < count($text); $i++) {
        for ($j = 0; $j < count($languages); $j++) {
            $symbol = mb_str_split($languages[$j], 1, "UTF-8");

            for ($k = 0; $k < count($symbol); $k++) {
                if ($text[$i] === $symbol[$k]) {
                    $tmp = $k - $key;

                    while ($tmp < 0) {
                        $tmp += count($symbol);
                    }
                    while ($tmp >= count($symbol)) {
                        $tmp -= count($symbol);
                    }

                    $res .= $symbol[$tmp];
                }
            }
        }

        if ($text[$i] === ' ') {
            $res .= ' ';
        }
        if ($text[$i] === ',') {
            $res .= ',';
        }
        if ($text[$i] === '.') {
            $res .= '.';
        }
        if ($text[$i] === '-') {
            $res .= '-';
        }
    }

    echo $res . PHP_EOL;
    output($res);
}

function cryptoCezar()
{
    setlocale(LC_ALL,"");

    echo "Доступні мови:\n1) Українська\n\t" . implode("\n\t", alphabet('ua')) . "\n2) Російська\n\t" . implode("\n\t", alphabet('ru')) ."\n3) Англійська\n\t" . implode("\n\t", alphabet('en')) . "\n4) Всі доступні мови.\n";

    $langChoise = prompt("Виберіть цифрою мову кодування");

    switch($langChoise) {
        case '1':
            $lang = alphabet('ua');
            break;

        case '2':
            $lang = alphabet('ru');
            break;

        case '3':
            $lang = alphabet('en');
            break;

        case '4':
            $lang = alphabet('all');
            break;

        default:
            line('Некорректне введення. Повторіть спробу.');
            CryptoCezar();
            break;
    }

    $method = prompt("Виберіть програму роботи:\n1) Шифрування\n2) Дешифрування\nВведіть цифру зі списку");

    switch ($method) {
        case '1':
            do {
                $key = prompt("Введіть ключ шифрування");
            } while ($key < 1 && $key >= mb_strlen($lang[0]) && is_numeric($key));
        
            $text = readline('Введіть текст для шифрування: ');
        
            encryption($key, $text, $lang);
            break;
        
        case '2':
            do {
                $key = prompt("Введіть ключ шифрування");
            } while ($key < 1 && $key >= mb_strlen($lang[0]) && is_numeric($key));

            decryption($key, $lang);
            break;

        default:
        line('Некорректне введення. Повторіть спробу.');
        CryptoCezar();
        break; 
    }
}
