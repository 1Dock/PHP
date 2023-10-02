<?php
include './db.php';

$pdo = getPDO();

$stmt = $pdo->prepare("
    SELECT
        `rests` . *,
        `categories` . `label` AS `category`,
        `rests_cuisines` . `rest_id`,
        `rests_cuisines` . `cuisine_id`,
        `cuisines` . `name` AS `cuisine_name`
    FROM
        `rests`
    LEFT JOIN
        `categories`
        ON `rests` . `category_id` = `categories` . `id`
    LEFT JOIN
        `rests_cuisines`
        ON `rests` . `id` = `rests_cuisines` . `rest_id`
    LEFT JOIN
        `cuisines`
        ON `rests_cuisines` . `cuisine_id` = `cuisines` . `id`
");

$stmt->execute([]);

$rests = $stmt->fetchAll();
print_r($rests);