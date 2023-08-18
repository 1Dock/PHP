<?php
//Написать функцию, принимающую на вход массив и возвращающую сумму всех чисел этого массива.
/*
$arr = [];

echo 'arr:' . "\n";
for ($i = 0; $i < 5; $i++) {
    $arr[] = rand(1, 9);
    echo ' - [' . $i . '] = ' .  $arr[$i] . "\n";
}

function getSum($arr) {
    $sum = 0;

    for ($i = 0; $i < count($arr); $i++) {
        $sum += $arr[$i];
    }

    return $sum;
}

echo "\n" . 'sumElementsArr: ' . getSum($arr);
*/

//Написать функцию, которая принимает на вход массив и возвращает максимальное число из этого массива.
/*
$arr = [];

echo 'arr:' . "\n";
for ($i = 0; $i < 5; $i++) {
    $arr[] = rand(1, 9);
    echo ' - [' . $i . '] = ' .  $arr[$i] . "\n";
}

function getMaxNum($arr) {
    $max = $arr[0];
    $indexNum = 0;

    for ($i = 1; $i < count($arr); $i++) {
        if ($arr[$i] > $max) {
            $max = $arr[$i];
            $indexNum = $i;
        }
    }

    return "\n" . 'maxNum - [' . $indexNum . '] = ' . $max;
}

echo getMaxNum($arr);
*/

//Написать функцию, принимающую в качестве аргумента массив и возвращающая с этого массива массив с только четными числами.
/*
$arr = [];

echo 'arr:' . "\n";
for ($i = 0; $i < 5; $i++) {
    $arr[] = rand(1, 9);
    echo ' - [' . $i . '] = ' .  $arr[$i] . "\n";
}

function getEvenArr($arr) {
    $evenArr = [];
    for ($i = 0; $i < count($arr); $i++) {
        if ($arr[$i] % 2 == 0) {
            $evenArr[] = $arr[$i];
        }
    }

    return $evenArr;
}

$evenArr = getEvenArr($arr);

echo "\n" . 'even_arr:' . "\n";
for ($k = 0; $k < count($evenArr); $k++) {
    echo ' - [' . $k . '] = ' .  $evenArr[$k] . "\n";
}
*/

//Написать функцию, принимающую в качестве аргумента целое число и возвращающая массив чисел, на которые это число делится без остатка.
//Вывести результат на экран со случайным числом.
/*
$num = rand(2, 9);

function getArrEvenOnNum($num) {
    $arr = [];

    for ($i = 2; $i <= 20; $i++) {
        if ($i % $num == 0) {
            $arr[] = $i;
        }
    }

    return $arr;
}

$arr = getArrEvenOnNum($num);

echo "\n" . 'arr_even_on_' . $num . ':' . "\n";
for ($k = 0; $k < count($arr); $k++) {
    echo ' - [' . $k . '] = ' .  $arr[$k] . "\n";
}
*/

//Описать функцию addRightDigit($a, $b), добавляющую к целому положительному числу $a справа цифру $b ($b лежит в диапазоне 0–9).
//Пример:
//   $a = 708; $b = 2;
//   addRightDigit($a,$b) - должна вернуть 7082
/*
$a = rand(100, 999);
$b = rand(0, 9);

function addRightDigit($a, $b) {
    $res = $a * 10 + $b;
    return $res;
}

echo 'a = ' . $a . "\n";
echo 'b = ' . $b . "\n\n";

echo 'result: ' . addRightDigit($a, $b);
*/

//Описать функцию timeToHMS($time), определяющую по времени $time (в секундах) содержащееся в нем количество часов, минут и секунд.
//Пример: $time = 3070
//00:51:10
$time = rand(0, 86400);

function timeToHMS($time) {
    $hour = 0;
    $hourStr = '0';

    $minute = 0;
    $minuteStr = '0';

    $second = 0;
    $secondStr = '0';

    if ($time >= 3600) {
        $hour = ($time - $time % 3600) / 3600;

        if ($hour > 9) {
            $hourStr = '';
        }
    }

    if ($time >= 60) {
        $minute = ($time % 3600 - ($time % 3600) % 60) / 60;

        if ($minute > 9) {
            $minuteStr = '';
        }
    }

    if ($time >= 0) {
        $second = $time % 3600 % 60;

        if ($second > 9) {
            $secondStr = '';
        }
    }

    return $hourStr . $hour . ':' . $minuteStr . $minute . ':' . $secondStr . $second;
}
echo 'seconds: ' . $time . "\n\n";
echo timeToHMS($time);