<?php

namespace CryptoLabs\Languages;

use function cli\line;
use function cli\prompt;

function alphabet(string $lang)
{
    $enDownLang = 'abcdefghjklmnopqrstuvwxyz';
    $enUpLang = 'ABCDEFGHJKLMNOPQRSTUVWXYZ';
    $uaDownLang = 'абвгґдеєжзиіїйклмнопрстуфхцчшщьюя';
    $uaUpLang = 'АБВГҐДЕЄЖЗИІЇЙКЛМНОПРСТУФХЦЧШЩЬЮЯ';
    $ruDownLang = 'абвгдеёжзийклмнопрстуфхцчшщъыьэюя';
    $ruUpLang = 'АБВГДЕЁЖЗИЙКЛМНОПРСТУФЦХЧШЩЪЫЬЭЮЯ';
    $digit = '1234567890';

    switch ($lang) {
        case "ua":
            return [$uaUpLang, $uaDownLang, $digit];
            break;

        case "en":
            return [$enUpLang, $enDownLang, $digit];
            break;

        case "ru":
            return [$ruUpLang, $ruDownLang, $digit];
            break;

        default:
            line('Не корректне введення. Повторіть спробу.');
            alphabet($lang);
            break;
    }
}

function chooseLang()
{
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
            chooseLang();
            break;
    }

    return $lang;
}