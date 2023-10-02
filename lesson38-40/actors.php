<?php
include './functions.php';
include './sql.php';

$dir = './films/';
$films = scandir($dir);

$actors = [];

foreach ($films as $film) {
    if ($film == '.' || $film == '..') {
        continue;
    }

    $subject = file_get_contents($dir . $film);
    $actors = array_merge(extractActors($subject), $actors);
}

$actors = array_unique($actors);
setActors($actors);