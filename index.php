<?php

//ФУНКЦИЯ ОТЛАДКИ,  отображает аргумент функции моноширинным шрифтом и со всеми пробелами между словами
function pr($s)
{
    echo '<pre>';
    print_r($s);
    echo '</pre>';
}

//ПОЛУЧЕНИЕ ПРОСТЫХ ЧИСЕЛ, ЗАДАНИЕ 1
//Собрать в массив числа от 1 до 50 и вывести только простые числа

function getSimpleNumbers ( ){
    $numbers = [];
    for ($num = 1; $num <= 50; $num++){
        $numbers[] = $num;
    }
    $simpleNumbers = [];

    foreach ($numbers as $simple) {
    //проходим по обычным числам и проверяем условия
        if ($simple == 1) {
            continue;
        } elseif ($simple == 2) {
            $simpleNumbers[] = $simple;
            continue;
        }
        $simpleChecker = true;
                //это наш модуль, который при проверке всех условий записывает число в массив простых чисел
        for ($i = 2; $i < $simple; $i++) {
                //прогоняем в счетчике, может ли число делиться на все числа от 2 до ("себя"-1) без остатка
            if ($simple % $i == 0) {
                //если на любой итерации число делится на другое число меньше себя без остатка - оно сложное
                $simpleChecker = false;
                //выходим из счетчика и не записываем это число в массив простых чисел
                break;
            }
        }
        if ($simpleChecker == true){
            $simpleNumbers[] = $simple;
        }
    }
    pr($simpleNumbers);
}
echo getSimpleNumbers();
echo '<br>';



//ПОЛИДНРОМЫ, ЗАДАНИЕ 2
//1) установить, является ли фраза полиндромом
//2) проверить, при транслитерации останется ли фраза полиндромом

function translit($value)
{
    $converter = array(
        'а' => 'a',    'б' => 'b',    'в' => 'v',    'г' => 'g',    'д' => 'd',
        'е' => 'e',    'ё' => 'e',    'ж' => 'zh',   'з' => 'z',    'и' => 'i',
        'й' => 'y',    'к' => 'k',    'л' => 'l',    'м' => 'm',    'н' => 'n',
        'о' => 'o',    'п' => 'p',    'р' => 'r',    'с' => 's',    'т' => 't',
        'у' => 'u',    'ф' => 'f',    'х' => 'h',    'ц' => 'c',    'ч' => 'ch',
        'ш' => 'sh',   'щ' => 'sch',  'ь' => '',     'ы' => 'y',    'ъ' => '',
        'э' => 'e',    'ю' => 'yu',   'я' => 'ya',

        'А' => 'A',    'Б' => 'B',    'В' => 'V',    'Г' => 'G',    'Д' => 'D',
        'Е' => 'E',    'Ё' => 'E',    'Ж' => 'Zh',   'З' => 'Z',    'И' => 'I',
        'Й' => 'Y',    'К' => 'K',    'Л' => 'L',    'М' => 'M',    'Н' => 'N',
        'О' => 'O',    'П' => 'P',    'Р' => 'R',    'С' => 'S',    'Т' => 'T',
        'У' => 'U',    'Ф' => 'F',    'Х' => 'H',    'Ц' => 'C',    'Ч' => 'Ch',
        'Ш' => 'Sh',   'Щ' => 'Sch',  'Ь' => '',     'Ы' => 'Y',    'Ъ' => '',
        'Э' => 'E',    'Ю' => 'Yu',   'Я' => 'Ya',
    );

    $value = strtr($value, $converter);
    return $value;
}
//фразы для проверок
$text1 = 'Тут как тут';
$text2 = 'Коту тащат уток';
$text3 = '15.01.2002 10:51';
$text4 = 'Я разуму уму заря';
$text5 = 'Искать такси';
$text6 = 'Диван мне вид';

//This function support utf-8 encoding, Human Language and Character Encoding Support:
function mb_strrev($str){
    $r = '';
    for ($i = mb_strlen($str); $i>=0; $i--) {
        $r .= mb_substr($str, $i, 1);
    }
    return $r;
}

function polyndromCheck (string $getText){
    //опускаем регистр полученной строки и удаляем оттуда все пробелы и символы
    //забираем строку без пробелов и записываем аналогичную строку с реверсом
    //если обе строки будут равны - исходная фраза является полиндромом
    $inputText = $getText;
    $symbols = array(':', '.', ' ', ',');
    $inputText = mb_strtolower(str_replace($symbols,'',$inputText));
    $palindromeReverseString = mb_strrev($inputText);
    var_dump($inputText);
    echo '<br>';

    if ($palindromeReverseString == $inputText) {
        echo '<br>';
        echo 'Фраза: "'. $getText. '" является полиндромом'.'<br>';
    } else { echo 'Фраза: "'. $getText. '" Не является полиндромом'.'<br>';}

    //делаем все то-же самое, только еще испльзуем фунцию, которая транслитом переводит нашу фразу
    $translate = translit($palindromeReverseString);
    $reverseTranslate = mb_strrev($translate);
    print_r($translate);

    if ($reverseTranslate == $translate) {
        echo '<br>';
        echo 'Фраза: "'. $getText. '" является полиндромом даже на транслите!'.'<br>';
    } else { echo 'Фраза: "'. $getText. '" Не является полиндромом на транслите'.'<br>';}
}
echo polyndromCheck($text1);
echo '<br>';


//ЗАДАНИЕ 3
//ДВУМЕРНЫЕ МАССИВЫ
////Создать 2-х мерный массив 8*8, который представляет собой шахматную доску.
//// Вывести массив на экран и в каждом элементе написать количество зерен из шахматной легенды:
//// "на первую клеточку положили – одно зернышко, на вторую – два, на третью – четыре,
//// увеличивая в два раза количество зернышек на каждой следующей из 64-х клеточек"

$chessDesk = array([],[]);
for ($massCount1 = 0, $numb = 1; $massCount1 < 8; $massCount1++) {
    $massCount3 = $numb;

    for ($massCount2 = 0, $b = $massCount3; $massCount2 < 8 ; $massCount2++ ) {
        $chessDesk[$massCount1][$massCount2] = $numb;
        $numb = $numb * 2;
    }
}
pr($chessDesk);
