<?php
global $pdo;
require_once 'db.php';

$page = $_GET['page'] ?? 1;
$offset = ((int)$page - 1) * 50;

$stmt = $pdo->prepare("
    SELECT
        `passenger` . `passenger_id`,
        `passenger` . `firstname`,
        `passenger` . `lastname`,
        `passenger` . `passportno`,
        `airport_geo_from` . `country` AS `country_from`,
        `airport_geo_from` . `city` AS `city_from`,
        `airport_geo_to` . `country` AS `country_to`,
        `airport_geo_to` . `city` AS `city_to`,
        `booking` . `price`
    FROM 
        `booking`
    INNER JOIN
        `passenger`
        ON `booking` . `passenger_id` = `passenger` . `passenger_id`
    INNER JOIN
        `flight`
        ON `booking` . `flight_id` = `flight` . `flight_id`
    INNER JOIN
        `airport_geo` AS `airport_geo_from`
        ON `flight` . `from` = `airport_geo_from` . `airport_id`
    INNER JOIN
        `airport_geo` AS `airport_geo_to`
        ON `flight` . `to` = `airport_geo_to` . `airport_id`
    LIMIT
        :offset, 50
");

$stmt->execute([':offset' => $offset]);
?>

<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css"
            rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9"
            crossorigin="anonymous">
    </head>
    <body>
    <table class="table table-secondary table-striped m-0">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Firstname</th>
            <th scope="col">Lastname</th>
            <th scope="col">Passport</th>
            <th scope="col">Flight</th>
            <th scope="col">Price</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $result = $stmt->fetchAll();
        foreach ($result as $row) {
        ?>
        <tr>
            <th scope="row">
                <a href="/profile.php?id=<?= $row['passenger_id'] ?>">BTN</a>
            </th>
            <td><?= $row['firstname'] ?></td>
            <td><?= $row['lastname'] ?></td>
            <td><?= $row['passportno'] ?></td>
            <td>
                <?= $row['country_from']?> (<a href="schedule.php?city_from=<?= $row['city_from'] ?>"><?= $row['city_from']?></a>) -
                <?= $row['country_to']?> (<a href="schedule.php?city_to=<?= $row['city_to'] ?>"><?= $row['city_to']?></a>)
            </td>
            <td><?= $row['price'] ?></td>
        </tr>
        <?php
        }
        ?>
        </tbody>
    </table>

    <div class="btn-group w-100" role="group" aria-label="First group">
        <?php
        for ($i = 1; $i <= 50; $i++) {
        ?>
            <a href="?page=<?= $i ?>" class="btn btn-light <?= $page == $i ? 'active' : '' ?>"><?= $i ?></a>
        <?php
        }
        ?>
    </div>
    </body>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>