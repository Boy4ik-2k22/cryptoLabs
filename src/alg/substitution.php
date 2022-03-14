<?php

namespace CryptoLabs\Algoritms\SubstitutionAlg;

use function cli\line;
use function CryptoLabs\Languages\chooseLang;
use function CryptoLabs\Main\input;
use function CryptoLabs\Main\keyInput;
use function CryptoLabs\Main\method;
use function CryptoLabs\Main\output;
use function CryptoLabs\Main\textInput;

function substitution(int $key, string $text, array $languages)
{
    $res = '';
    $text = mb_str_split($text, 1, "UTF-8");

    echo $res . PHP_EOL;
    output("\\cypher3.txt", $res);
}

function cryptoSubstitution()
{
    setlocale(LC_ALL, "");

    $lang = chooseLang();
    $method = method();

    switch ($method) {
        case '1':
            substitution(keyInput(), textInput(), $lang);
            break;

        case '2':
            substitution(keyInput(), input("\\cypher3.txt"), $lang);
            break;

        default:
            line('Некорректне введення. Повторіть спробу.');
            cryptoSubstitution();
            break;
    }
}
