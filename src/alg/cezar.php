<?php

namespace CryptoLabs\Algoritms\CezarAlg;

use function cli\line;
use function CryptoLabs\Languages\chooseLang;
use function CryptoLabs\Main\input;
use function CryptoLabs\Main\keyInput;
use function CryptoLabs\Main\method;
use function CryptoLabs\Main\output;
use function CryptoLabs\Main\textInput;

function cezar(int $key, string $text, array $languages, string $type = 'encode')
{
    $res = '';
    $text = mb_str_split($text, 1, "UTF-8");

    for ($i = 0; $i < count($text); $i++) {
        for ($j = 0; $j < count($languages); $j++) {
            $symbol = mb_str_split($languages[$j], 1, "UTF-8");

            for ($k = 0; $k < count($symbol); $k++) {
                if ($text[$i] === $symbol[$k]) {
                    if ($type === 'decode') {
                        $tmp = $k - $key;
                    } else {
                        $tmp = $k + $key;
                    }

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
    output("\\cypher1.txt", $res);
}

function cryptoCezar()
{
    setlocale(LC_ALL, "");

    $lang = chooseLang();
    $method = method();

    switch ($method) {
        case '1':
            cezar(keyInput(), textInput(), $lang);
            break;

        case '2':
            cezar(keyInput(), input("\\cypher1.txt"), $lang, 'decode');
            break;

        default:
            line('Некорректне введення. Повторіть спробу.');
            CryptoCezar();
            break;
    }
}
