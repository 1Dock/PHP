<?php
//Написать функцию transformToUpperCase, которая принимает на вход строку и набор символов, которые необходимо преобразовать в верхний регистр.
//
//  echo transformToUpperCase(
//    'helloworld', 'hw'
//  ); # HelloWorld

function transformToUpperCase($str, $search) {
    for ($j = 0; $j < mb_strlen($search); $j++) {
        $symbol = mb_substr($search, $j, 1);

        for ($i = 0; $i < mb_strlen($str); $i++) {
            $partOne = mb_substr($str, 0, $i);
            $partTwo = mb_substr($str, $i, 1);
            $partThree = mb_substr($str, $i + 1);

            if ($partTwo == $symbol) {
                $partTwo = mb_strtoupper($partTwo);
            }

            $str = $partOne . $partTwo . $partThree;
        }
    }

    return $str;
}

echo transformToUpperCase(
    'helloworld',
    'hw'
);