<?php
//Написать функцию findAndPaste, которая принимает на вход строку $str, набор искомых символов $search и строку вставки $paste.
//Данная функция делает вставку строки $paste перед каждым найденным символом строки $search в строке $str и возвращает ее.
//К примеру
//
//echo findAndPaste(
//  ‘helloworld’,
//  ‘hw’,
//  ‘!’
//); # - !hello!world

function findAndPaste($str, $search, $paste) {

    for ($i = 0; $i < mb_strlen($str); $i++) {
        for ($n = 0; $n < mb_strlen($search); $n++) {
            $searchSymbol = mb_substr($search, $n, 1);
            $partOne = mb_substr($str, 0, $i);
            $partTwo = mb_substr($str, $i, 1);
            $partThree = mb_substr($str, $i + 1);

            if ($partTwo == $searchSymbol) {
                $partTwo = $paste . $partTwo;
                $i += mb_strlen($paste);
            }

            $str = $partOne . $partTwo. $partThree;
        }
    }

    return $str;
}

echo findAndPaste('helloworld', 'hw', '!');