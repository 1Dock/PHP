<?php
function getMembers($file)
{
    $pattern = '/<span itemprop="name">(.+?)<\/span>/u';
    $desc = file_get_contents($file);
    $matches = [];

    preg_match_all($pattern, $desc, $matches);

    return $matches[1];
}

$dir = './films/';
$files = scandir($dir);

$names = [];

foreach ($files as $file) {
    if ($file == '.' || $file == '..') {
        continue;
    }

    $members = getMembers($dir . $file);

    foreach ($members as $member) {
        if (!isset($names[$member])) {
            $names[$member] = 0;
        }

        $names[$member]++;
    }
}

print_r($names);