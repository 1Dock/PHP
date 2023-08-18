<?php
//Написать функцию transformToUpperCase, которая принимает на вход строку и набор символов, которые необходимо преобразовать в верхний регистр.
//
//  echo transformToUpperCase(
//    'helloworld', 'hw'
//  ); # HelloWorld

$str = 'helloworld';
$search = 'hw';

function transformToUpperCase($str, $search) {
    for ($i = 0; $i < mb_strlen($search); $i++) {
        $symbol = mb_substr($search, $i, 1);
        $pos = mb_strpos($str, $symbol);

        while ($pos !== false) {
            $partOne = mb_substr($str, 0, $pos);
            $partTwo = mb_substr($str, $pos, 1);
            $partThree = mb_substr($str, $pos + 1);

            if ($partTwo == $symbol) {
                $partTwo = mb_strtoupper($partTwo);
            }

            $str = $partOne . $partTwo . $partThree;
            $pos = mb_strpos($str, $symbol, $pos + 1);
        }
    }

    return $str;
}

echo transformToUpperCase($str, $search);