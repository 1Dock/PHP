<?php
include './functions.php';
include './patterns.php';
include './sql.php';

$dir = './films/';
$files = scandir($dir);

$allCountries = getCountries();
$allGenres = getGenres();
$allActors = getActors();
$films = [];

foreach ($files as $file) {
    if ($file == '.' || $file == '..') {
        continue;
    }

    $subject = file_get_contents($dir . $file);

    $year = extractYear($subject);
    $countries = extractCountries($subject);
    $genres = extractGenres($subject);
    $duration = extractDuration($subject);
    $actors = extractActors($subject);

    $countriesIds = [];
    $genresIds = [];
    $actorsIds = [];

    foreach ($countries as $c1) {
        foreach ($allCountries as $c2) {
            if ($c1 == $c2['name']) {
                $countriesIds[] = $c2['id'];
                break;
            }
        }
    }

    foreach ($genres as $g1) {
        foreach ($allGenres as $g2) {
            if ($g1 == $g2['name']) {
                $genresIds[] = $g2['id'];
                break;
            }
        }
    }

    foreach ($actors as $a1) {
        foreach ($allActors as $a2) {
            if ($a1 == $a2['name']) {
                $actorsIds[] = $a2['id'];
                break;
            }
        }
    }

    $film = [
        'year' => $year,
        'duration' => $duration,
        'countries_ids' => $countriesIds,
        'genres_ids' => $genresIds,
        'actors_ids' => $actorsIds
    ];

    $films[] = $film;
}

setFilms($films);