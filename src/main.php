<?php 

namespace CryptoLabs\Main;

use function cli\prompt;
use function cli\line;
use function CryptoLabs\Algoritms\XorAlg\cryptoXor;
use function CryptoLabs\Algoritms\CezarAlg\cryptoCezar;

function choose()
{
    $choosenAlg = prompt('Введите алгоритм шифрования');
    return $choosenAlg;
}

function main()
{
    $algoritms = ["cezar", "xor"];
    $userChoise = choose();

    switch ($userChoise) {
        case "cezar":
            cryptoCezar();
            break;

        case "xor":
            cryptoXor();
            break;

        default:
            line('Неправельно ввели название алгортма. Повторите попытку.');
            main();
            break;
    }
}
