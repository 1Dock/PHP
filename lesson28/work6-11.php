<?php

class Hero
{
    var $number;
    var $health;
    var $originalHealth;
    var $strength;
    var $player;

    function __construct($number, $health, $strength)
    {
        $this->number = $number;
        $this->health = $this->originalHealth = $health;
        $this->strength = $strength;
    }

    function setPlayer($player)
    {
        $this->player = $player;
    }

    function takeDamage($amount, $hero = null)
    {
        $this->health -= $amount;
        if ($this->health <= 0) {
            if ($hero !== null) {
                if (rand(0, 1)) {
                    $hero->takeDamage($this->strength * 0.1);
                    echo 'Герой ' . $hero->number . ' нанес предсмертный удар с силой ' . $hero->strength * 0.1 . "\n";
                } else {
                    foreach ($hero->player->heroes as $enemyHero) {
                        $enemyHero->takeDamage($this->strength * 2);
                    }
                    echo 'Герой ' . $this->number . ' взорвал гранату с силой ' . $this->strength * 2 . "\n";
                }
            }
            $this->player->removeHero($this);
        } else {
            $tenPercent = $this->originalHealth * 0.1;
            if ($this->health < $tenPercent) {
                $tenPercent *= 0.5;
                $this->health += $tenPercent;
                echo 'Герой ' . $this->number . ' вколол адриналин + ' . $tenPercent . ' к здоровью!' . "\n";
            }
        }
    }

    function attack($enemyHero)
    {
        if ($this->health > 0) {
            echo 'Герой ' . $this->number . ' (' . $this->health . ') атакует ' . $enemyHero->number . ' (' . $enemyHero->health . ')' . "\n";
            $enemyHero->takeDamage($this->strength, $this);
        }
    }
}

class Player
{
    var $heroes = [];

    function __construct($heroes)
    {
        foreach ($heroes as $hero) {
            $hero->setPlayer($this);
        }
        $this->heroes = $heroes;
    }

    function removeHero($deadHero)
    {
        foreach ($this->heroes as $i => $hero) {
            if ($hero == $deadHero) {
                unset($this->heroes[$i]);
            }
        }
    }
}

class Game
{
    var $player1;
    var $player2;

    function __construct($player1, $player2)
    {
        $this->player1 = $player1;
        $this->player2 = $player2;
    }

    function battle()
    {
        while (true) {
            if (!$this->player1->heroes) {
                echo 'Победила команда 2-го игрока';
                break;
            }

            if (!$this->player2->heroes) {
                echo 'Победила команда 1-го игрока';
                break;
            }

            echo '-------------------------------' . "\n";
            echo 'Игрок 1 атакует' . "\n\n";
            foreach ($this->player1->heroes as $hero1) {
                foreach ($this->player2->heroes as $hero2) {
                    $hero1->attack($hero2);
                }
            }

            echo '-------------------------------' . "\n";
            echo 'Игрок 2 атакует' . "\n\n";
            foreach ($this->player2->heroes as $hero2) {
                foreach ($this->player1->heroes as $hero1) {
                    $hero2->attack($hero1);
                }
            }
        }
    }
}

$heroes1 = $heroes2 = [];
for ($i = 0; $i < 5; $i++) {
    $heroes1[] = new Hero($i + 1, rand(1000, 2500), rand(100, 170));
    $heroes2[] = new Hero($i + 1, rand(1000, 2500), rand(100, 170));
}

$game = new Game(
    new Player($heroes1),
    new Player($heroes2)
);

$game->battle();