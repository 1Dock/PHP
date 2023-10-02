<?php
include './functions.php';
include './sql.php';

$dir = './films/';
$films = scandir($dir);

$genres = [];

foreach ($films as $film) {
    if ($film == '.' || $film == '..') {
        continue;
    }

    $subject = file_get_contents($dir . $film);
    $genres = array_merge(extractGenres($subject), $genres);
}

$genres = array_unique($genres);
setGenres($genres);