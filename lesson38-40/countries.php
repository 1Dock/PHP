<?php
include './functions.php';
include './sql.php';

$dir = './films/';
$films = scandir($dir);

$countries = [];

foreach ($films as $film) {
    if ($film == '.' || $film == '..') {
        continue;
    }

    $subject = file_get_contents($dir . $film);
    $countries = array_merge(extractCountries($subject), $countries);
}

$countries = array_unique($countries);
setCountries($countries);