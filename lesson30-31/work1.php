<?php

interface FighterInterface
{
    public function takeDamage($amount, FighterInterface $hero = null);

    public function attack(FighterInterface $hero);

    public function getPlayer();

    public function getNumber();

    public function getHealth();

    public function getStrength();
}

class Bunker implements FighterInterface
{
    private $player;
    private $number = 'Бункер';
    private $heroes = [];
    private $health;

    function __construct(Player $player, $heroes)
    {
        $this->player = $player;
        $this->heroes = $heroes;
        $this->health = rand(1000, 2000);
    }

    public function getPlayer()
    {
        return $this->player;
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function getHealth()
    {
        return $this->health;
    }

    public function getStrength()
    {
        $damage = 0;

        foreach ($this->heroes as $hero) {
            $damage += $hero->getStrength();
        }

        return $damage;
    }

    public function takeDamage($amount, FighterInterface $hero = null)
    {
        $this->health -= $amount;

        if ($this->health <= 0) {
            $this->player->setHeroes($this->heroes);
        }
    }

    public function attack(FighterInterface $hero)
    {
        if ($this->health > 0) {
            $damage = $this->getStrength();
            echo 'Героий с бункера наносят колективный урон (' . $damage . ') ' . $hero->getNumber() . ' (' . $hero->getHealth() . ')' . "\n";

            $hero->takeDamage($damage, $this);
        }
    }
}

class Hero implements FighterInterface
{
    private $player;
    private $number;
    private $health;
    private $originalHealth;
    private $strength;

    public function __construct($number, $health, $strength)
    {
        $this->number = $number;
        $this->health = $this->originalHealth = $health;
        $this->strength = $strength;
    }

    public function getPlayer()
    {
        return $this->player;
    }

    public function setPlayer($player)
    {
        $this->player = $player;
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function getHealth()
    {
        return $this->health;
    }

    public function getStrength()
    {
        return $this->strength;
    }

    public function takeDamage($amount, FighterInterface $hero = null)
    {
        $this->health -= $amount;

        if ($this->health <= 0) {
            if ($hero !== null) {
                if (rand(0, 1)) {
                    $hero->takeDamage($this->strength * 0.1);
                    echo 'Герой ' . $hero->getNumber() . ' нанес предсмертный удар с силой ' . $hero->getStrength() * 0.1 . "\n";
                } else {
                    foreach ($hero->getPlayer()->getHeroes() as $enemyHero) {
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

    public function attack(FighterInterface $enemyHero)
    {
        if ($this->health > 0) {
            echo 'Герой ' . $this->number . ' (' . $this->health . ') атакует ' . $enemyHero->getNumber() . ' (' . $enemyHero->getHealth() . ')' . "\n";
            $enemyHero->takeDamage($this->strength, $this);
        }
    }
}

class Player
{
    private $heroes = [];
    private $bunkerUsed = false;

    public function __construct($heroes)
    {
        foreach ($heroes as $hero) {
            $hero->setPlayer($this);
        }

        $this->heroes = $heroes;
    }

    public function setHeroes($heroes) {
        $this->heroes = $heroes;
    }

    public function getHeroes()
    {
        return $this->heroes;
    }

    public function removeHero($deadHero)
    {
        foreach ($this->heroes as $i => $hero) {
            if ($hero == $deadHero) {
                unset($this->heroes[$i]);
            }
        }

        if (!$this->bunkerUsed) {
            echo 'Игрок посадил героев в бункер' . "\n";

            $this->heroes = [new Bunker($this, $this->heroes)];
            $this->bunkerUsed = true;
        }
    }
}

class Game
{
    private $player1;
    private $player2;

    public function __construct($player1, $player2)
    {
        $this->player1 = $player1;
        $this->player2 = $player2;
    }

    public function battle()
    {
        while (true) {
            if (!$this->player1->getHeroes()) {
                echo 'Победила команда 2-го игрока';
                break;
            }

            if (!$this->player2->getHeroes()) {
                echo 'Победила команда 1-го игрока';
                break;
            }

            echo '-------------------------------' . "\n";
            echo 'Игрок 1 атакует' . "\n\n";
            foreach ($this->player1->getHeroes() as $hero1) {
                foreach ($this->player2->getHeroes() as $hero2) {
                    $hero1->attack($hero2);
                }
            }

            echo '-------------------------------' . "\n";
            echo 'Игрок 2 атакует' . "\n\n";
            foreach ($this->player2->getHeroes() as $hero2) {
                foreach ($this->player1->getHeroes() as $hero1) {
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