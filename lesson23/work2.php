<?php
//Написать функцию getAbc, возвращающую  алфавит английских символов  в виде строки.
//'abcdefghijklmnopqrstuvwxyz'

function getAbc() {
    return 'abcdefghijklmnopqrstuvwxyz';
}

//Написать функцию getArrayOfStrings, возвращающую массив из заданного количества элементов,
//каждый из которых является набором из случайных симоволов латинского алфавита произвольной длины.
function getRandomStr($length = null) {

    if ($length == null) {
        $length = rand(5, 10);
    }

    $abc = getAbc();
    $str = '';

    for ($i = 0; $i < $length; $i++) {
        $rand = rand(0, mb_strlen($abc) - 1);
        $str .= mb_substr($abc, $rand, 1);
    }

    return $str;
}

function getArrayOfStr($num) {
    $result = [];

    for ($i = 0; $i < $num; $i++) {
        $result[] = getRandomStr();
    }

    return $result;
}

var_dump(getArrayOfStr(5));