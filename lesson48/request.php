<?php
$date = date('Y-m-d');
$path = 'demands/' . $date . '.csv';

$rows = [];

if (file_exists($path)) {
    if (($handle = fopen($path, "r")) !== FALSE) {
        while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $rows[] = $row;
        }
        fclose($handle);
    }
}

$rows[] = [$_POST['name'], $_POST['phone'], $_SERVER["REMOTE_ADDR"], $_POST['from-site']];
$fp = fopen($path, 'w');
foreach ($rows as $row) {
    fputcsv($fp, $row);
}
fclose($fp);

header("location: /");