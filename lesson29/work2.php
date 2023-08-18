<?php

class Player
{
    var $randNum;
    var $points;

    function __construct()
    {
        $this->randNum = 0;
        $this->points = 0;
    }

    function setRandNum()
    {
        $this->randNum = rand(0, 9999);
    }

    function incPoints()
    {
        $this->points++;
    }
}

function compare($p1, $p2)
{
    if ($p1->randNum < $p2->randNum) {
        echo '+1' . "\n";
        $p1->incPoints();
    } else {
        echo "\n";
    }
}

function battle($k, $p1, $p2)
{
    if (!$k) {
        echo 'меньше ';
        compare($p1, $p2);
    } else {
        echo 'больше ';
        compare($p2, $p1);
    }
}

$player1 = new Player();
$player2 = new Player();

for ($i = 1; $i <= 5; $i++) {
    echo $i . '. Партия ';
    $player1->setRandNum();
    $player2->setRandNum();
    $k = rand(0, 1);

    if ($i % 2 != 0) {
        echo 'игрок 1)' . "\n";
        battle($k, $player1, $player2);
    } else {
        echo 'игрок 2)' . "\n";
        battle($k, $player2, $player1);
    }

    echo '1) ' . $player1->randNum . "\n";
    echo '2) ' . $player2->randNum . "\n\n";
}

if ($player1->points > $player2->points) {
    echo 'выйграл 1-ый игрок';
} else {
    echo 'выйграл 2-ой игрок';
}