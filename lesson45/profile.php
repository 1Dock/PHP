<?php
global $pdo;
require_once 'db.php';

$stmtPassenger = $pdo->prepare("
    SELECT
        `passenger` . `firstname`,
        `passenger` . `lastname`
    FROM 
        `passenger`
    WHERE 
        `passenger` . `passenger_id` = :id
");

$stmtBooking = $pdo->prepare("
    SELECT 
        COUNT(*) as `countBooking`
    FROM 
        `booking` 
    WHERE 
        `booking` . `passenger_id` = :id
");

$stmtCountriesTo = $pdo->prepare("
    SELECT 
        COUNT(*) as `countTo`,
        `airport_geo` . `country`
    FROM 
        `booking`
    INNER JOIN
        `flight`
        ON `booking` . `flight_id` = `flight` . `flight_id`
    INNER JOIN
        `airport_geo`
        ON `flight` . `to` = `airport_geo` . `airport_id`
    WHERE 
        `booking` . `passenger_id` = :id
    GROUP BY 
        `airport_geo` . `country`
");

$stmtCountriesFrom = $pdo->prepare("
    SELECT 
        COUNT(*) as `countFrom`,
        `airport_geo` . `country`
    FROM 
        `booking`
    INNER JOIN
        `flight`
        ON `booking` . `flight_id` = `flight` . `flight_id`
    INNER JOIN
        `airport_geo`
        ON `flight` . `from` = `airport_geo` . `airport_id`
    WHERE 
        `booking` . `passenger_id` = :id
    GROUP BY 
        `airport_geo` . `country`
");

$passengerId = $_GET['id'];

$stmtPassenger->execute([':id' => $passengerId]);
$stmtBooking->execute([':id' => $passengerId]);
$stmtCountriesTo->execute([':id' => $passengerId]);
$stmtCountriesFrom->execute([':id' => $passengerId]);

$passenger = $stmtPassenger->fetch();
$booking = $stmtBooking->fetch();
?>

<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css"
      rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9"
      crossorigin="anonymous">
</head>
<body>
<header>
    <div class="d-flex align-items-center">
        <a href="/" class="btn btn-secondary m-1">BACk</a>
        <h1>
            <?= $passenger['firstname'] . ' ' . $passenger['lastname'] ?>
        </h1>
    </div>
    <h4>BOOKING: <?= $booking['countBooking'] ?></h4>
</header>
<div class="d-flex align-items-start">
    <table class="table table-secondary table-striped">
        <thead>
        <tr>
            <th scope="col">Count To</th>
            <th scope="col">To Country</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $countriesTo = $stmtCountriesTo->fetchAll();
        foreach ($countriesTo as $countryTo) {
        ?>
            <tr>
                <td><?= $countryTo['countTo'] ?></td>
                <td><?= $countryTo['country'] ?></td>
            </tr>
        <?php
        }
        ?>
        </tbody>
    </table>

    <table class="table table-secondary table-striped">
        <thead>
        <tr>
            <th scope="col">Count To</th>
            <th scope="col">To Country</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $countriesFrom = $stmtCountriesFrom->fetchAll();
        foreach ($countriesFrom as $countryFrom) {
        ?>
            <tr>
                <td><?= $countryFrom['countFrom'] ?></td>
                <td><?= $countryFrom['country'] ?></td>
            </tr>
        <?php
        }
        ?>
        </tbody>
    </table>
</div>
</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>