<?php

interface PerformInterface
{
    public function protrude();
}

class Doll implements PerformInterface
{
    private $type;
    private $gender;
    private $age;
    private $color;
    private $text;

    public function __construct($type, $gender, $age, $color, $text)
    {
        $this->type = $type;
        $this->gender = $gender;
        $this->age = $age;
        $this->color = $color;
        $this->text = $text;
    }

    public function protrude()
    {
        return "\t" . $this->type . ' кукла: ' . $this->text . "\n";
    }
}

class Puppeteer implements PerformInterface
{
    private $gender;
    private $voice;
    private $talents;
    private $dolls;

    public function __construct($gender, $voice, $talents, $dolls)
    {
        $this->gender = $gender;
        $this->voice = $voice;
        $this->talents = $talents;
        $this->dolls = $dolls;
    }

    public function protrudeDolls()
    {
        $result = "\n";

        foreach ($this->dolls as $doll) {
            $result .= $doll->protrude();
        }

        return $result;
    }

    public function protrude()
    {
        echo 'Куклавод:' . $this->protrudeDolls() . "\n";
    }
}

class Actor implements PerformInterface
{
    private $gender;
    private $age;
    private $text;

    public function __construct($gender, $age, $text)
    {
        $this->gender = $gender;
        $this->age = $age;
        $this->text = $text;
    }

    public function protrude()
    {
        echo 'Актер: ' . $this->text . "\n\n";
    }
}

class Staging
{
    private $queues;

    public function __construct($queues)
    {
        $this->queues = $queues;
    }

    public function protrude()
    {
        foreach ($this->queues as $queue) {
            $queue->protrude();
        }
    }
}

class Viewer
{
    private $reaction;

    public function __construct($reaction)
    {
        $this->reaction = $reaction;
    }

    public function applaud()
    {
        echo 'Зритель: ' . $this->reaction . "\n\n";
    }
}

class Theater
{
    private $staging;
    private $viewers;

    public function __construct(Staging $staging, $viewers)
    {
        $this->staging = $staging;
        $this->viewers = $viewers;
    }

    public function startTheater()
    {
        $this->staging->protrude();

        foreach ($this->viewers as $viewer) {
            $viewer->applaud();
        }
    }
}

function getRandItems($arr, $count)
{
    $res = $arr;
    shuffle($res);
    return array_slice($res, 0, $count);
}

$genders = ['male', 'female'];
$texts = ['Hello World', 'HW', 'qwerty', '123'];

$types = ['Matryoshka', 'Porcelain', 'Reborn', 'China'];
$colors = ['white', 'black'];

$voices = ['low', 'medium', 'high'];
$talents = ['cooking', 'dance', 'sing', 'evaluate'];

$reactions = ['Nice!', 'GG', 'good', 'Wow!'];

function getRandDoll()
{
    global $types, $genders, $colors, $texts;
    $type = getRandItems($types, 1)[0];
    $gender = getRandItems($genders, 1)[0];
    $age = rand(12, 30);
    $color = getRandItems($colors, 1)[0];
    $text = getRandItems($texts, 1)[0];

    return new Doll($type, $gender, $age, $color, $text);
}

$dolls = [];
for ($i = 0; $i < 2; $i++) {
    $dolls[] = getRandDoll();
}

function getRandPuppeteer()
{
    global $genders, $voices, $talents, $dolls;
    $gender = getRandItems($genders, 1)[0];
    $voice = getRandItems($voices, 1)[0];
    $talents_ = getRandItems($talents, rand(1, count($talents)));

    return new Puppeteer($gender, $voice, $talents_, $dolls);
}

$puppeteer = getRandPuppeteer();

function getRandActor()
{
    global $genders, $texts;
    $gender = getRandItems($genders, 1)[0];
    $age = rand(20, 50);
    $text = getRandItems($texts, 1)[0];

    return new Actor($gender, $age, $text);
}

$actor = getRandActor();

$peoples = [$puppeteer, $actor];
$staging = new Staging($peoples);

function getRandViewer()
{
    global $reactions;
    $reaction = getRandItems($reactions, 1)[0];

    return new Viewer($reaction);
}

$viewers = [];
for ($i = 0; $i < 3; $i++) {
    $viewers[] = getRandViewer();
}

$theater = new Theater($staging, $viewers);
$theater->startTheater();