<?php
include './db.php';

function setFilms($films) {
    $pdo = getPDO();

    $stmt = $pdo->prepare("TRUNCATE TABLE `films`");
    $stmt->execute();

    $stmt = $pdo->prepare("TRUNCATE TABLE `films_countries`");
    $stmt->execute();

    $stmt = $pdo->prepare("INSERT INTO `films` (`year`, `duration`) VALUES (:year, :duration)");

    foreach ($films as $film) {
        $stmt->execute([
            ':year' => $film['year'],
            ':duration' => $film['duration']
        ]);

        $filmId = (int)$pdo->lastInsertId();

        $fc_stmt = $pdo->prepare("INSERT INTO `films_countries` (`film_id`, `country_id`) VALUES (:film_id, :country_id)");
        foreach ($film['countries_ids'] as $country_id) {
            $fc_stmt->execute([
                ':film_id' => $filmId,
                ':country_id' => $country_id
            ]);
        }

        $fg_stmt = $pdo->prepare("INSERT INTO `films_genres` (`film_id`, `genre_id`) VALUES (:film_id, :genre_id)");
        foreach ($film['genres_ids'] as $genre_id) {
            $fg_stmt->execute([
                ':film_id' => $filmId,
                ':genre_id' => $genre_id
            ]);
        }

        $fa_stmt = $pdo->prepare("INSERT INTO `films_actors` (`film_id`, `actor_id`) VALUES (:film_id, :actor_id)");
        foreach ($film['actors_ids'] as $actor_id) {
            $fa_stmt->execute([
                ':film_id' => $filmId,
                ':actor_id' => $actor_id
            ]);
        }
    }
}

function getCountries() {
    $pdo = getPDO();

    $stmt = $pdo->prepare("SELECT * FROM `countries`");
    $stmt->execute();

    return $stmt->fetchAll();
}

function setCountries($countries) {
    $pdo = getPDO();

    $stmt = $pdo->prepare("TRUNCATE TABLE `countries`");
    $stmt->execute();

    $stmt = $pdo->prepare("INSERT INTO `countries` (`name`) VALUES (:name)");

    foreach ($countries as $country) {
        $stmt->execute([':name' => $country]);
    }
}

function getGenres() {
    $pdo = getPDO();

    $stmt = $pdo->prepare("SELECT * FROM `genres`");
    $stmt->execute();

    return $stmt->fetchAll();
}

function setGenres($genres) {
    $pdo = getPDO();

    $stmt = $pdo->prepare("TRUNCATE TABLE `genres`");
    $stmt->execute();

    $stmt = $pdo->prepare("INSERT INTO `genres` (`name`) VALUES (:name)");

    foreach ($genres as $genre) {
        $stmt->execute([':name' => $genre]);
    }
}

function getActors() {
    $pdo = getPDO();

    $stmt = $pdo->prepare("SELECT * FROM `actors`");
    $stmt->execute();

    return $stmt->fetchAll();
}

function setActors($actors) {
    $pdo = getPDO();

    $stmt = $pdo->prepare("TRUNCATE TABLE `actors`");
    $stmt->execute();

    $stmt = $pdo->prepare("INSERT INTO `actors` (`name`) VALUES (:name)");

    foreach ($actors as $actor) {
        $stmt->execute([':name' => $actor]);
    }
}