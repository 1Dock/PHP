<?php

global $pdo;
require_once 'db.php';

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
        `airport_from` . `iata` AS `iata_from`, 
        `airport_from` . `name` AS `name_from`,
        `airport_to` . `iata` AS `iata_to`, 
        `airport_to` . `name` AS `name_to`
    FROM 
        `booking`
    INNER JOIN
        `passenger`
        ON `booking` . `passenger_id` = `passenger` . `passenger_id`
    INNER JOIN
        `flight`
        ON `booking` . `flight_id` = `flight` . `flight_id`
    INNER JOIN
        `airport` AS `airport_from`
        ON `airport_from` . `airport_id` = `flight` . `from`
    INNER JOIN
        `airport` AS `airport_to`
        ON `airport_to` . `airport_id` = `flight` . `to`
    " . $orderBy . "
    LIMIT
        :offset, 50
");

$result = $stmt->execute([
        ':offset' => $offset
]);

if (!$result) {
    echo 'Error';
    return;
}

?>
<style>
    .mr-10 {
        margin-right: 10px;
    }

    .bold {
        font-weight: bold;
    }
</style>
<table border="1">
    <thead>
        <tr>
            <th>Имя</th>
            <th>Фамилия</th>
            <th>Пасспорт</th>
            <th>Цена</th>
            <th>Место</th>
            <th><a href="/?sort=departure">Вылет</a></th>
            <th>Аэропорт</th>
            <th>Код</th>
            <th>Прилет</th>
            <th>Аэропорт</th>
            <th>Код</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $result = $stmt->fetchAll();
            foreach ($result as $row) {
                ?>
                <tr>
                    <td><?= $row['firstname'] ?></td>
                    <td><?= $row['lastname'] ?></td>
                    <td><?= $row['passportno'] ?></td>
                    <td><?= $row['price'] ?></td>
                    <td><?= $row['seat'] ?></td>
                    <td><?= $row['departure'] ?></td>
                    <td><?= $row['name_from'] ?></td>
                    <td><?= $row['iata_from'] ?></td>
                    <td><?= $row['arrival'] ?></td>
                    <td><?= $row['name_to'] ?></td>
                    <td><?= $row['iata_to'] ?></td>
                </tr>
                <?php
            }
        ?>
    </tbody>
</table>
<?php
for ($i = 1; $i <= 50; $i++) {
    $bold = $i == $page ? 'bold' : '';
    echo '<a class="mr-10 ' . $bold . '"  href="?page=' . $i . '">' . $i . '</a>';
} 
?>