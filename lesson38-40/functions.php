<?php
include './patterns.php';

function extractParam($regex, $subject) {
    $matches = [];
    preg_match_all($regex, $subject, $matches);

    return $matches[1];
}

function extractYear($subject) {
    global $yearRegex;
    $groups = extractParam($yearRegex, $subject);
    return count($groups) > 0 ? (int)$groups[0] : 0;
}

function extractCountries($subject) {
    global $countryRegex;
    return extractParam($countryRegex, $subject);
}

function extractGenres($subject) {
    global $genreRegex;
    return extractParam($genreRegex, $subject);
}

function extractDuration($subject) {
    global $durationRegex;
    $groups = extractParam($durationRegex, $subject);
    return count($groups) > 0 ? (int)$groups[0] : 0;
}

function extractActors($subject) {
    global $actorRegex;
    return extractParam($actorRegex, $subject);
}