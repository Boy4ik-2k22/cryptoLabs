<?php

namespace CryptoLabs\Algoritms\SubstitutionAlg;

use function cli\line;
use function CryptoLabs\Languages\chooseLang;
use function CryptoLabs\Main\input;
use function CryptoLabs\Main\method;
use function CryptoLabs\Main\output;

function randomGen($min, $max, $quantity)
{
    $numbers = range($min, $max);
    shuffle($numbers);
    return array_slice($numbers, 0, $quantity);
}

function generateTextChypher(array $lang)
{
    $alpCypher = [];
    $alpUp = mb_str_split($lang[0], 1, "UTF-8");
    $alpDown = mb_str_split($lang[1], 1, "UTF-8");
    $digit = mb_str_split($lang[2], 1, "UTF-8");
    $alphLenth = count($alpUp);
    $alpCypherNum = randomGen(0, $alphLenth - 1, $alphLenth);
    $randomDigit = randomGen(0, 9, 10);

    for ($i = 0; $i < (($alphLenth * 2) + 10); $i++) {
        if ($i < $alphLenth) {
            $alpCypher[$i] = $alpUp[$alpCypherNum[$i]];
        }
        if ($i >= $alphLenth && $i < ($alphLenth * 2)) {
            $alpCypher[$i] = $alpDown[$alpCypherNum[$i - $alphLenth]];
        }
        if ($i >= ($alphLenth * 2) && $i < (($alphLenth * 2) + 10)) {
            $alpCypher[$i] = $digit[$randomDigit[$i - ($alphLenth * 2)]];
        }
    }

    return $alpCypher;
}

function substitution(string $text, array $language)
{
    $res = '';
    $alp = '';
    $text = mb_str_split($text, 1, "UTF-8");
    $cypherAlp = generateTextChypher($language);

    foreach ($language as $string) {
        $string = mb_str_split($string, 1, "UTF-8");
        foreach ($string as $symbol) {
            $alp .= $symbol;
        }
    }

    $alp = mb_str_split($alp, 1, "UTF-8");

    for ($i = 0; $i < count($text); $i++) {
        foreach ($alp as $key => $symb) {
            if ($text[$i] === $symb) {
                $res .= $cypherAlp[$key];
            }
        }
        if ($text[$i] === ' ') {
            $res .= " ";
        }
        if ($text[$i] === '.') {
            $res .= ".";
        }
        if ($text[$i] === ',') {
            $res .= ",";
        }
        if ($text[$i] === '-') {
            $res .= "-";
        }
    }
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
            substitution(input("\\..\\input\\text.txt"), $lang);
            break;

        case '2':
            //decode;
            break;

        default:
            line('Некорректне введення. Повторіть спробу.');
            cryptoSubstitution();
            break;
    }
}
