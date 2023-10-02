<?php
global $pdo;
require_once 'db.php';

$filter = '';
if (isset($_GET['city_from'])) {
    $filter = '`airport_geo_from` . `city` = "' . $_GET['city_from'] . '"';
}

if (isset($_GET['city_to'])) {
    $filter = '`airport_geo_to` . `city` = "' . $_GET['city_to'] . '"';
}

$page = $_GET['page'] ?? 1;
$offset = ((int)$page - 1) * 10;

$stmt = $pdo->prepare("
    SELECT
        `flightschedule` . `flightno`,
        `airport_geo_from` . `country` AS `country_from`,
        `airport_geo_from` . `city` AS `city_from`,
        `airport_geo_to` . `country` AS `country_to`,
        `airport_geo_to` . `city` AS `city_to`,
        `flightschedule` . `monday`,
        `flightschedule` . `tuesday`,
        `flightschedule` . `wednesday`,
        `flightschedule` . `thursday`,
        `flightschedule` . `friday`,
        `flightschedule` . `saturday`,
        `flightschedule` . `sunday`
    FROM
        `flightschedule`
    INNER JOIN
        `airport_geo` AS `airport_geo_from`
        ON `flightschedule` . `from` = `airport_geo_from` . `airport_id`
    INNER JOIN
        `airport_geo` AS `airport_geo_to`
        ON `flightschedule` . `to` = `airport_geo_to` . `airport_id`
    WHERE
        " . $filter . "
    LIMIT
        :offset, 10
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
    <a href="/" class="btn btn-secondary m-1">BACk</a>
    <table class="table table-secondary m-0">
        <thead>
        <tr>
            <th scope="col">FlightNo</th>
            <th scope="col">Flight</th>
            <th scope="col">Monday</th>
            <th scope="col">Tuesday</th>
            <th scope="col">Wednesday</th>
            <th scope="col">Thursday</th>
            <th scope="col">Friday</th>
            <th scope="col">Saturday</th>
            <th scope="col">Sunday</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $daysWeek = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
        $schedules = $stmt->fetchAll();

        foreach ($schedules as $schedule) {
        ?>
            <tr>
                <td><?= $schedule['flightno'] ?></td>
                <td>
                    <?= $schedule['country_from']?> (<a href="schedule.php?city_from=<?= $schedule['city_from'] ?>"><?= $schedule['city_from']?></a>) -
                    <?= $schedule['country_to']?> (<a href="schedule.php?city_to=<?= $schedule['city_to'] ?>"><?= $schedule['city_to']?></a>)
                </td>
                <?php
                foreach ($daysWeek as $dayWeek) {
                ?>
                    <td class="<?= $schedule[$dayWeek] ? 'bg-success' : 'bg-warning' ?>">
                        <?= $schedule[$dayWeek] ?>
                    </td>
                <?php
                }
                ?>
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