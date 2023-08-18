<?php
//Собрать строку из 10 случайных символов английского алфавита. Вывести на экран эту строку таким образом,
//чтобы все символы с четным порядковым номером (алфавитного порядка) были выделены жирным.

$abc = 'abcdefghijklmnopqrstuvwxyz';
$str = '';

for ($i = 0; $i < 10; $i++) {
    $random = rand(0, mb_strlen($abc) - 1);
    $char = mb_substr($abc, $random, 1);

    if (($random + 1) % 2 == 0) {
        $char = '<strong>' . mb_strtoupper($char) . '</strong>';
    }

    $str .= $char;
}

echo $str;