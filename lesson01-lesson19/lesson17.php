<?php
//Написать функцию divisors(...), которая принимает на вход число $n и выводит список всех его делителей через запятую. Решить задачу с помощью рекурсии.
//Например divisors(6): 1,2,3,6
/*
$num = rand(1, 10);

function divisors($n, $m = 1) {
    if ($m <= $n) {
        if ($n % $m == 0) {
            echo $m . ',';
        }
        divisors($n, $m + 1);
    }
}

echo 'num = ' . $num . "\n";
echo divisors($num);
*/

//Написать функцию isHappyNumber(...), которая принимает на вход шестизначное число,
//и возвращает true если число является счастливым (когда сумма первых трех цифр равна сумме последних), иначе возвращает false. Решить задачу с помощью рекурсии.

/*
$num = rand(100000, 999999);

function isHappyNumber($n, $sum1 = 0, $sum2 = 0) {
    if ($n >= 1) {
        if ($n >= 999) {
            $sum1 += $n % 10;
        } else {
            $sum2 += $n % 10;
        }
        return isHappyNumber($n / 10, $sum1, $sum2);
    } else {
        return $sum1 == $sum2;
    }
}

echo 'num = ' . $num . "\n";
echo var_dump(isHappyNumber($num));
*/

//Написать функцию, принимающую на вход число $n и возвращающая сумму его цифр. Решить задачу с использованием рекурсии (без циклов).

/*
$num = rand(100, 999);

function getSumNumbers($n, $sum = 0) {
    if ($n >= 1) {
        $sum += $n % 10;
    } else {
        return $sum;
    }
    return getSumNumbers($n / 10, $sum);
}

echo 'num = ' . $num . "\n";
echo getSumNumbers($num);
*/

//Написать функцию, которая принимает на вход целое положительное число $n и возвращает массив всех квадратных чисел от 1 до $n.
//Решить задачу с использованием рекурсии (без циклов).
//К примеру если число $n=27, то результат должен быть массивом: [1, 4, 9, 16, 25];

$num = rand(1, 30);

function getSquares($n, $k = []) {
    if ($n >= 1) {
        $s = sqrt($n);
        if ($s == floor($s)) {
            $k[] = $s;
        }
        return getSquares($n - 1, $k);
    } else {
        return sort($k);
    }
}

echo 'num = ' . $num . "\n";
print_r(getSquares($num));