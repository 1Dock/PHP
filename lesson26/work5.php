<?php
//Собрать массив $arr из 10 элементов, каждый из которых представляет из себя строку из случайных символов латинского алфавита.
//И далее необходимо:
//1. Заменить все символы во всех элементах массива $arr  на их порядковые номера латинского алфавита (bac - 102).
//2. Собрать сумму всех цифр в массив $sum.
//3. В массиве $sum каждое число преобразовать в строки по следующему сценарию: сначала подбирается соответствующий символ под двузначный номер если такое возможно, далее под однозначный номер. К примеру:
//   132722 = 13(n) - 2(c) - 7(h) - 22(w) = nchw
//4. Объединить все полученные строки массива $sum в одну единую строку.

function getSumNum($num) {
    $sum = 0;

    for ($i = $num; $i > 0; $i /= 10) {
        $sum += $i % 10;
    }

    return $sum;
}

function getStrFromNum($num, $alphabet) {
    $str = '';
    $index = 0;

    do {
        for ($i = 2; $i > 0; $i--) {
            $part = mb_substr($num, $index, $i);

            if ($part < mb_strlen($alphabet)) {
                $str .= $alphabet[$part];
                $index += $i;
                break;
            }
        }
    } while ($index < mb_strlen($num));

    return $str;
}

$alphabet = 'abcdefghijklmnopqrstuvwxyz';
$arrNum = [];
$arrSum = [];
$arrStr = [];
$string = '';

for ($i = 0; $i < 10; $i++) {
    $str = '';
    $num = null;

    for ($n = 0; $n < 3; $n++) {
        $randIndex = rand(0, mb_strlen($alphabet) - 1);

        $str .= mb_substr($alphabet, $randIndex, 1);
        $num .= $randIndex;
    }

    $sumNum = getSumNum($num);

    $arrNum[$str] = $num;
    $arrSum[] = $sumNum;
    $arrStr[] = getStrFromNum($sumNum, $alphabet);
    $string .= $arrStr[$i];
}

echo "\n" . 'строки в цифры:' . "\n";
print_r($arrNum);
echo "\n" . 'цифры в суммы:' . "\n";
print_r($arrSum);
echo "\n" . 'суммы в строки:' . "\n";
print_r($arrStr);
echo "\n" . 'единая строка:' . "\n";
echo $string;