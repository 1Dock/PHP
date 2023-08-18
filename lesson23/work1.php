<?php
$br = '<br>';
$str = 'Привет';

for ($i = 0; $i < mb_strlen($str); $i++) {
    echo mb_substr($str, $i, 1) . $br;
}