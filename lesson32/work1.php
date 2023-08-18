<?php

class Suit
{
    private $isTrump = false;
    private $type;

    public function __construct($type)
    {
        $this->type = $type;
    }

    public function isTrump()
    {
        return $this->isTrump;
    }

    public function setIsTrump($isTrump)
    {
        $this->isTrump = $isTrump;
    }
}

class Card
{
    private $rang;
    private $label;
    private $suit;

    public function __construct($rang, $label, $suit)
    {
        $this->rang = $rang;
        $this->label = $label;
        $this->suit = $suit;
    }

    public function getRang()
    {
        $level = 0;
        if ($this->suit->isTrump()) {
            $level = 10;
        }

        return $this->rang + $level;
    }

    public function getSuit()
    {
        return $this->suit;
    }
}

class Player
{
    private $name;
    private $cards = [];

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function setCard($card)
    {
        $this->cards[] = $card;
    }

    public function calc()
    {
        $power = 0;

        foreach ($this->cards as $card) {
            $power += $card->getRang();
        }

        return $power;
    }
}

$suits = [new Suit('spades'), new Suit('hearts'), new Suit('diamonds'), new Suit('clubs')];

$ranges = [
    '6', '7', '8', '9', '10',
    'V', 'D', 'K', 'T'
];

$cards = [];
foreach ($suits as $suit) {
    foreach ($ranges as $rang => $label) {
        $cards[] = new Card($rang + 1, $label, $suit);
    }
}
shuffle($cards);

$players = [new Player('Бывалый'), new Player('Безимянный')];

$i = 0;
foreach ($cards as $card) {
    $players[$i % 2]->setCard($card);
    $players[$i % 2]->setCard($card);

    $i++;
    if ($i == 11) {
        break;
    }
}

$trumpSuit = $cards[++$i]->getSuit();
$trumpSuit->setIsTrump(true);

var_dump([
    $players[0]->calc(),
    $players[1]->calc()
]);

var_dump($trumpSuit);

var_dump($players);