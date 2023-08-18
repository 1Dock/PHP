<?php
class Human
{
    var $name;
    var $surname;
    var $patronymic;

    function __construct($name, $surname, $patronymic)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->patronymic = $patronymic;
    }
}

function getRandItem($arr) {
    return $arr[rand(0, count($arr) - 1)];
}

$names = [
    'Сергеев',
    'Орехов',
    'Волокитин',
    'Авдеев',
    'Родионов',
    'Маслов',
    'Жуков',
    'Хохлов',
];

$surnames = [
    'Станислав',
    'Кузьма',
    'Захар',
    'Сидор',
    'Модест',
    'Варфоломей',
    'Аполлон',
    'Варфоломей',
];

$patronymics = [
    'Григорьевич',
    'Тигранович',
    'Иванович',
    'Артёмович',
    'Михайлович',
    'Даниэльевич',
    'Артёмович',
    'Михайлович',
];

$humans = [];

for ($i = 0; $i < 20; $i++) {
    $humans[] = new Human(getRandItem($names), getRandItem($surnames), getRandItem($patronymics));
}

print_r($humans);