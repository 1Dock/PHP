<?php
//Смоделировать игровой процесс пошаговой стратегии. В игре принимают участие два игрока, у каждого игрока по 5 героев.
//У каждого героя есть свойства Жизнь (случайное число в диапазоне от 1000 до 2500) и Сила (случайное число в диапазоне от 20-170).
//
//Игровой процесс состоит из раундов. При каждом раунде поочередно герои первого игрока наносят урон в размере своей силы поочередно каждому герою второго игрока,
//затем урон наносят герои второго игрока героям первого, на этом раунд заканчивается и переход к следующему раунду.
//Игра продолжается до тех пор пока у одного из игроков не останется живых героев. Выводить на экран отчеты каждого раунда.

function getRandomHero($index)
{
    $health = rand(1000, 2500);
    return [
        'number' => $index,
        'health' => $health,
        'original-health' => $health,
        'strength' => rand(100, 170)
    ];
}

function filterHeroes($heroes)
{
    foreach ($heroes as $i => $hero) {
        if ($hero['health'] <= 0) {
            unset($heroes[$i]);
        }
    }

    return $heroes;
}

function battle($heroes1, $heroes2, $player)
{
    echo 'Игрок ' . $player . ' атакует' . "\n\n";
    foreach ($heroes1 as $key1 => &$hero1) {
        foreach ($heroes2 as $key2 => &$hero2) {
            $result = attackHero($hero1, $hero2);
            $hero1 = $result[0];
            $hero2 = $result[1];
            if ($hero2['health'] <= 0) {
                unset($heroes2[$key2]);
            }
        }
    }
    echo '-------------------------------' . "\n";

    return [$heroes1, $heroes2];
}

function attackHero($hero1, $hero2)
{
    $hero2['health'] -= $hero1['strength'];
    echo 'Герой ' . $hero1['number'] . ' (' . $hero1['health'] . ') атакует ' . $hero2['number'] . ' (' . $hero2['health'] . ')' . "\n";

    if ($hero2['health'] > 0) {
        $tenPercent = $hero2['original-health'] * 0.1;
        if ($hero2['health'] < $tenPercent) {
            $tenPercent *= 0.5;
            $hero2['health'] += $tenPercent;
            echo 'Герой ' . $hero2['number'] . ' вколол адриналин + ' . $tenPercent . ' к здоровью!' . "\n";
        }
    } else {
        $hero1['health'] -= $hero2['strength'] * 0.1;
        echo 'Герой ' . $hero2['number'] . ' нанес предсмертный удар с силой ' . $hero2['strength'] * 0.1 . "\n";
    }

    return [$hero1, $hero2];
}

$heroes1 = $heroes2 = [];
for ($i = 1; $i <= 5; $i++) {
    $heroes1[] = getRandomHero($i);
    $heroes2[] = getRandomHero($i);
}

while (true) {
    $heroes1 = filterHeroes($heroes1);
    $heroes2 = filterHeroes($heroes2);

    if (count($heroes1) == 0 || count($heroes2) == 0) {
        if (count($heroes1) == 0) {
            echo 'Игрок 2 выйграл';
        } else {
            echo 'Игрок 1 выйграл';
        }
        break;
    }

    $result = battle($heroes1, $heroes2, 1);
    $heroes1 = $result[0];
    $heroes2 = $result[1];

    $result = battle($heroes2, $heroes1, 2);
    $heroes1 = $result[0];
    $heroes1 = $result[1];
}

print_r($heroes1);
print_r($heroes2);