<?php
include './functions.php';
include './db.php';

$pdo = getPDO();

$stmt = $pdo->prepare("SELECT * FROM `categories`");
$stmt->execute();

$rests = [];
$types = $stmt->fetchAll();

foreach ($types as $type) {
    $maxPage = getMaxPage($type['type'], 1);
    for ($i = 1; $i <= $maxPage; $i++) {
        $rests = array_merge($rests, getRestsFromPage($type['type'], $i));
    }
}

foreach ($rests as &$rest) {
    foreach ($types as $type) {
        if ($type['type'] == $rest['category']) {
            $id = $type['id'];
        }
    }

    $rest['category'] = $id;
}

$cuisines = [];
foreach ($rests as $restC) {
    $cuisines = array_merge($cuisines, $restC['cuisine'] ?? []);
}

$cuisines = array_unique($cuisines);

$stmt = $pdo->prepare("TRUNCATE TABLE `cuisines`");
$stmt->execute();

$stmt = $pdo->prepare("
    INSERT INTO
        `cuisines` (
            `name`
        ) VALUES (
            :name
        )
    
");

$cuisinesMap = [];
foreach ($cuisines as $cuisine) {
    $stmt->execute([
        ":name" => $cuisine
    ]);
    $cuisinesMap[$cuisine] = $pdo->lastInsertId();
}

$stmt = $pdo->prepare("TRUNCATE TABLE `rests`");
$stmt->execute();

$stmt = $pdo->prepare("
    INSERT INTO 
        `rests` (
            `category_id`,
            `name`,
            `link`,
            `price_min`,
            `price_max`,
            `options`
        ) VALUES (
            :category_id,
            :name,
            :link,
            :price_min,
            :price_max,
            :options
        )
");

$stmtRc = $pdo->prepare("
    INSERT INTO
        `rests_cuisines` (
            `rest_id`,
            `cuisine_id`
        ) VALUES (
            :rest_id,
            :cuisine_id
        )
");

foreach ($rests as $rest) {
    $stmt->execute([
        ':category_id' => $rest['category'],
        ':name' => $rest['name'],
        ':link' => $rest['link'],
        ':price_min' => $rest['price']['min'],
        ':price_max' => $rest['price']['max'],
        ':options' => $rest['options'] ?? '',
    ]);

    $restId = $pdo->lastInsertId();

    foreach ($rest['cuisine'] as $cuisine) {
        $stmtRc->execute([
            ':rest_id' => $restId,
            ':cuisine_id' => $cuisinesMap[$cuisine],
        ]);
    }
}