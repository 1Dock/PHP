<?php

class User
{
    var $name;
    var $access = 'смертный';

    function __construct($name)
    {
        $this->name = $name;
        $this->sayHello();
    }

    function sayHello()
    {
        echo $this->name . ': Привет меня зовут ' . $this->name . '! И я - ' . $this->access . '!<br>';
    }

    function letsCode(User $user)
    {
        echo $this->name . ': Привет, ' . $user->name . '! Я - ' . $this->name . ', пойдем кодить!<br>';
    }
}

class Admin extends User
{
    var $access = 'бесмертный';

    function ban($user)
    {
        echo $this->name . ': ' . $user->name . ' получил бан!<br>';
    }
}

$akim = new User('Аким');
$gulnaz = new User('Гульназ');
$abzal = new Admin('Абзал');

$akim->letsCode($gulnaz);
$abzal->ban($akim);
$abzal->letsCode($gulnaz);