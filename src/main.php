<?php

namespace CryptoLabs\Main;

use function cli\prompt;
use function cli\line;
use function CryptoLabs\Algoritms\XorAlg\cryptoXor;
use function CryptoLabs\Algoritms\CezarAlg\cryptoCezar;

setlocale(LC_ALL,"");

function choose()
{
    $choosenAlg = prompt('Введіть алгоритм шифрування');
    return $choosenAlg;
}

function main()
{
    line("Цифрою виберіть алгоритм шифрування:\n1) Cezar\n2) XOR\n");
    $userChoise = choose();

    switch ($userChoise) {
        case "1":
            cryptoCezar();
            break;

        case "2":
            cryptoXor();
            break;

        default:
            line('Не корректне введення. Повторіть спробу.');
            main();
            break;
    }
}
