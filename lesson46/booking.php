<?php
global $pdo;
require_once './src/includes.php';

$page = $_GET['page'] ?? 1;
$offset = ((int)$page - 1) * 50;

$orderBy = '';
if (isset($_GET['sort']) && in_array($_GET['sort'], ['departure', 'price'])) {
    $orderBy = 'ORDER BY ' . $_GET['sort'] . ' DESC';
}

$stmt = $pdo->prepare("
    SELECT
        `booking` . `price`,
        `booking` . `seat`,
        `passenger` . *,
        `flight` . `departure`, 
        `flight` . `arrival`,
        `airport_from` . `country` AS `country_from`, 
        `airport_from` . `city` AS `city_from`,
        `airport_to` . `country` AS `country_to`, 
        `airport_to` . `city` AS `city_to`
    FROM 
        `booking`
    INNER JOIN
        `passenger`
        ON `booking` . `passenger_id` = `passenger` . `passenger_id`
    INNER JOIN
        `flight`
        ON `booking` . `flight_id` = `flight` . `flight_id`
    INNER JOIN
        `airport_geo` AS `airport_from`
        ON `airport_from` . `airport_id` = `flight` . `from`
    INNER JOIN
        `airport_geo` AS `airport_to`
        ON `airport_to` . `airport_id` = `flight` . `to`
    " . $orderBy . "
    LIMIT
        :offset, 50
");

$stmt->execute([
    ':offset' => $offset
]);

$result = $stmt->fetchAll();

$stmt = $pdo->prepare("SELECT COUNT(*) AS `count` FROM `booking` LIMIT 1");
$stmt->execute();
$count = $stmt->fetch();

$data = [
    'data' => $result,
    'pagination' => new Pagination((int)$count['count'], 50, $_GET['page'] ?? 1)
];

$view = new Booking();
$view->render($data);