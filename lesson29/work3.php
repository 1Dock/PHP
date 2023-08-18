<?php

class Card
{
    var $rank;
    var $suit;
    var $trump;

    function __construct($rank, $suit, $trump)
    {
        $this->rank = $rank;
        $this->suit = $suit;
        $this->trump = $trump;
    }

    function getRank()
    {
        return $this->trump ? $this->rank + 10 : $this->rank;
    }
}

class Player
{
    var $fullName;
    var $cards;

    function __construct($fullName, $cards)
    {
        $this->fullName = $fullName;
        $this->cards = $cards;
    }

    function getStrengthCards()
    {
        $sum = 0;
        foreach ($this->cards as $card) {
            $sum += $card->getRank();
        }

        return $sum;
    }
}

$randSuit = rand(0, 3);
$cards = [];
for ($i = 0; $i < 4; $i++) {
    for ($j = 0; $j < 9; $j++) {
        $cards[] = new Card($j, $i, $randSuit == $i);
    }
}

$fullNames = [
    'Михеев Лев Викторович',
    'Киселева Ариана Ярославовна',
    'Волков Сергей Глебович',
    'Нестерова Ева Львовна',
    'Соколов Тимур Максимович',
    'Семенова Милана Александровна',
    'Шмелева Варвара Григорьевна',
    'Романов Тимофей Иванович',
];

$players = [];
$winPlayer = 0;
for ($i = 0; $i < 4; $i++) {
    $randNameIndex = rand(0, count($fullNames) - 1);
    $playerName = array_splice($fullNames, $randNameIndex, 1)[0];

    $playerCards = [];
    for ($n = 0; $n < 9; $n++) {
        $randCardIndex = rand(0, count($cards) - 1);
        $playerCards[] = array_splice($cards, $randCardIndex, 1)[0];
    }

    $players[] = new Player($playerName, $playerCards);

    $strengthCard = $players[$i]->getStrengthCards();
    echo $players[$i]->fullName . ' -> rank: ' . $strengthCard . "\n";

    if ($strengthCard > $players[$winPlayer]->getStrengthCards()) {
        $winPlayer = $i;
    }
}

echo "\n" . 'больше шансов выйграть у ' . $players[$winPlayer]->fullName;