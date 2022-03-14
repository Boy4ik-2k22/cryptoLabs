<?php

namespace CryptoLabs\Main;

use function cli\prompt;
use function cli\line;
use function CryptoLabs\Algoritms\XorAlg\cryptoXor;
use function CryptoLabs\Algoritms\CezarAlg\cryptoCezar;
use function CryptoLabs\Algoritms\SubstitutionAlg\cryptoSubstitution;

function chooseAlg()
{
    line("Цифрою виберіть алгоритм шифрування:\n1) Цезар\n2) XOR\n3) Метод Заміни\n");

    $choosenAlg = prompt('Введіть алгоритм шифрування');

    if (is_numeric($choosenAlg)) {
        if ($choosenAlg < 1 || $choosenAlg > 3) {
            line("Не корректне введення! Спробуйте ще раз.");
            chooseAlg();
        } else {
            return $choosenAlg;
        }
    }
}

function method()
{
    $choosenMethod = prompt("Виберіть програму роботи:\n1) Шифрування\n2) Дешифрування\nВведіть цифру зі списку");

    if (is_numeric($choosenMethod)) {
        if ($choosenMethod < 1 || $choosenMethod > 2) {
            line("Не корректне введення! Спробуйте ще раз.");
            method();
        } else {
            return $choosenMethod;
        }
    }
}

function output(string $fileName, string $text)
{
    $filePath = __DIR__ . '\\output\\';

    file_put_contents(realpath($filePath) . $fileName, $text, LOCK_EX);
}

function input(string $fileName)
{
    $filePath = __DIR__ . '\\output\\';
    return file_get_contents($filePath . $fileName);
}

function keyInput()
{
    $readKey = prompt("Введіть ключ шифрування");

    if (!is_numeric($readKey)) {
        line("Не корректне введення! Спробуйте ще раз.");
        keyInput();
    } else {
        return $readKey;
    }
}

function textInput()
{
    return readline('Введіть текст для шифрування: ');
}

function main()
{
    setlocale(LC_ALL, "");
    
    $userChoise = chooseAlg();

    switch ($userChoise) {
        case "1":
            cryptoCezar();
            break;

        case "2":
            cryptoXor();
            break;

        case "3":
            cryptoSubstitution();
            break;

        default:
            line('Не корректне введення. Повторіть спробу.');
            main();
            break;
    }
}
