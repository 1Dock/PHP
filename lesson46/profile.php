<?php
global $pdo;
require_once './src/includes.php';

if (!isset($_GET['pid'])) {
    $view = new Layout();
    $view->render('Not found(404)');
}

$stmt = $pdo->prepare("
    SELECT
        `passenger` . *,
        COUNT(*) as `count`
    FROM
        `passenger`
    INNER JOIN 
        `booking`
        ON `booking` . `passenger_id` = `passenger` . `passenger_id`
    WHERE
        `passenger` . `passenger_id` = :pid
    LIMIT
        1
");

$stmt->execute([
    ':pid' => $_GET['pid']
]);

$passenger = $stmt->fetch();

$stmtFrom = $pdo->prepare("
    SELECT
        `airport_geo`.*,
        COUNT(*) AS `count`
    FROM
        `booking`
    INNER JOIN
        `flight`
        ON `booking`.`flight_id` = `flight`.`flight_id`
    INNER JOIN
        `airport_geo`
        ON `airport_geo`.`airport_id` = `flight`.`from`
    WHERE
        `booking`.`passenger_id` = :pid
    GROUP BY
        `airport_geo`.`country`
");

$stmtFrom->execute([
    ':pid' => $_GET['pid']
]);

$stmtTo = $pdo->prepare("
    SELECT
        `airport_geo`.*,
        COUNT(*) AS `count`
    FROM
        `booking`
    INNER JOIN
        `flight`
        ON `booking`.`flight_id` = `flight`.`flight_id`
    INNER JOIN
        `airport_geo`
        ON `airport_geo`.`airport_id` = `flight`.`to`
    WHERE
        `booking`.`passenger_id` = :pid
    GROUP BY
        `airport_geo`.`country`
");

$stmtTo->execute([
    ':pid' => $_GET['pid']
]);

(new Profile())->render([
    'passenger' => $passenger,
    'countries-from' => $stmtFrom->fetchAll(),
    'countries-to' => $stmtTo->fetchAll()
]);