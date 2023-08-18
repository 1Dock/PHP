<?php
//Собрать строку из 10 случайных символов латинского алфавита. Вывести на экран эту строку таким образом,
//чтобы все гласные были в верхнем регистре, а все согласные выделены курсивом. Обратите внимание на букву Y.

$abc = 'abcdefghijklmnopqrstuvwxyz';
$vowel = 'aeiouy';
$str = '';

for ($i = 0; $i < 10; $i++) {
    $random = rand(0, mb_strlen($abc) - 1);
    $char = mb_substr($abc, $random, 1);

    if (mb_strpos($vowel, $char)) {
        $char = strtoupper($char);
    } else {
        $char = '<em>' . $char . '</em>';
    }

    $str .= $char;
}

echo $str;