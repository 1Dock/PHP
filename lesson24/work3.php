<?php
$arr = [
    'one' => 'Hello',
    'World'
];

$i = 0;
foreach ($arr as $key => $value) {
    echo $key . ' => ' . $value . '<br>';
    $i++;
}

echo 'Кол-во итераций: ' . $i . '<br>';
print_r($arr);