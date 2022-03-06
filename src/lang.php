<?php

namespace CryptoLabs\Languages;

use function cli\line;

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
            return [$uaDownLang, $uaUpLang, $digit];
            break;

        case "en":
            return [$enDownLang, $enUpLang, $digit];
            break;

        case "ru":
            return [$ruDownLang, $ruUpLang, $digit];
            break;

        case 'all':
            return [$uaDownLang, $uaUpLang, $enDownLang, $enUpLang, $ruDownLang, $ruUpLang, $digit];
            break;            
        default:
            line('Не корректне введення. Повторіть спробу.');
            alphabet($lang);
            break;
    }
}
