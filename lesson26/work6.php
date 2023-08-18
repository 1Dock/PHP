<?php
//У вас есть список операций:
//1. Увеличить на (increaseBy) - увеличивает значение на заданное количество
//2. Уменьшить на  (reduceBy) - уменьшает значение на заданное количество
//3. Увеличить в (increaseByTimes) - увеличивает значение в заданное количество раз
//4. Уменьшить в (reduceByTimes) - уменьшает значение в заданное количество раз
//
//Необходимо:
//1. Собрать список ($operations), представляющий из себя случайную последовательность 5-ти операций;
//2. Применить последовательность операций ($operations) к числу 10, заданный аргумент каждой операции соответствует порядковому номеру самой операции + 1
//3. Собрать 2 массива из 10 случайных чисел. Применить к каждому элементу первого массива последовательность операций ($operations),
//в качестве заданного аргумента каждой операции использовать соответствующий элемент из второго массива.
function increaseBy($a, $b) {return $a + $b;}
function reduceBy($a, $b) {return $a - $b;}
function increaseByTimes($a, $b) {return $a * $b;}
function reduceByTimes($a, $b) {return $a / $b;}

function doMath($a, $b, $o) {
    if ($o == '+') {return increaseBy($a, $b);}
    else if ($o == '-') {return reduceBy($a, $b);}
    else if ($o == '*') {return increaseByTimes($a, $b);}
    else if ($o == '/') {return reduceByTimes($a, $b);}

    return 0;
}

function operation1($a, $c) {
    for ($i = 0; $i < 5; $i++) {
        $order = $i + 1;
        $a = doMath($a, $order, $c[$i]);
    }

    return $a;
}
function operation2($a, $b, $c) {
    for ($i = 0; $i < 5; $i++) {
        $a = doMath($a, $b, $c[$i]);
    }

    return $a;
}

$operations = [];
$num = 10;
$arr1 = [];
$arr2 = [];

for ($i = 0; $i < 5; $i++) {
    $operations[] = rand(1, 4);

    if ($operations[$i] == 1) {$operations[$i] = '+';}
    else if ($operations[$i] == 2) {$operations[$i] = '-';}
    else if ($operations[$i] == 3) {$operations[$i] = '*';}
    else {$operations[$i] = '/';}
}

for ($i = 0; $i < 5; $i++) {
    $arr1[] = rand(1, 10);
    $arr2[] = rand(1, 10);
}

echo '#1: ' . "\n";
print_r($operations);

echo "\n" . '#2:' . "\n" . 'result: 10 => ' . operation1($num, $operations) . "\n\n";

echo '#3: ' . "\n";
print_r($arr1);
print_r($arr2);

echo "\n" . 'result: ' . "\n";
for ($i = 0; $i < 5; $i++) {
    $arr1[$i] = operation2($arr1[$i], $arr2[$i], $operations);
}
print_r($arr1);