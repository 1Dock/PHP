<?php
//Определить в какой день недели будет ваш день рождения, если месяц начался со дня $day - номер дня недели
//(случайное число в диапазоне от 1 - 7, где 1 - пн, 2 - вт, 3 - ср, … 7 - вс).
$day = rand(1, 7);
$birthdate = rand(1, 31);

echo 'первый ден месяца: ' . $day;
echo '<br>';
echo 'день недели где будет день рождения: ' . $birthdate;
echo '<br>';

$birthday = ($birthdate + ($day - 1)) % 7;

$monthStartDayStr = '';
$birthdayStr = '';

if ($day == 1) {$monthStartDayStr = 'понедельника';}
elseif ($day == 2) {$monthStartDayStr = 'вторника';}
elseif ($day == 3) {$monthStartDayStr = 'среды';}
elseif ($day == 4) {$monthStartDayStr = 'четверга';}
elseif ($day == 5) {$monthStartDayStr = 'пятницы';}
elseif ($day == 6) {$monthStartDayStr = 'субботы';}
else {$monthStartDayStr = 'воскресенья';}

if ($birthday == 1) {$birthdayStr = 'понедельник';}
elseif ($birthday == 2) {$birthdayStr = 'вторник';}
elseif ($birthday == 3) {$birthdayStr = 'среду';}
elseif ($birthday == 4) {$birthdayStr = 'четверг';}
elseif ($birthday == 5) {$birthdayStr = 'пятницу';}
elseif ($birthday == 6) {$birthdayStr = 'субботу';}
else {$birthdayStr = 'воскресенье';}

echo 'Если месяц начнется с ' . $monthStartDayStr . ', то мой день рождения будет в ' . $birthdayStr . '.';

echo '<br><br>';

//2. Земляне засекли НЛО на расстояннии $s (случайное число от 0 - 1500) км от земли.
//Опеределить в каком из слоев атмосферы оно находится. Вывести на экран ответ в след виде:
//3. Учитывая разный диапазон высот слоев атмосферы, НЛО чаще всего будет оказываться в экзосфере.
//Перепишите сценарий программы из задачи 2 таким образом, чтобы НЛО могло появляться в каждом слое атмосферы с равной вероятностью.
//Выводить ответ в таком же виде как и в предыдущей задаче.
$height = rand(0 , 1500);
$sphere = '';

if ($height >= 1200) {$sphere = 'Экзосфера (1200 - 1500)';}
elseif ($height >= 900) {$sphere = 'Термосфера (900 - 1200)';}
elseif ($height >= 600) {$sphere = 'Мезосфера (600 - 900)';}
elseif ($height >= 300) {$sphere = 'Стратосфера (300 - 600)';}
elseif ($height >= 0) {$sphere = 'Тропосфера (0 - 300)';}

echo 'Высота: ' . $height . ' км - это ' . $sphere;

echo '<br><br>';

//Для целого числа $k (случайное число от 1 до 99) напечатать фразу «Мне k лет», учитывая при этом,
//что при некоторых значениях $k слово «лет» надо заменить на слово «год» или «года».
$k = rand(1, 99);

$old = '';
$lastNum = $k % 10;

if ($k >= 11 && $k <= 14 || $lastNum == 0 || $lastNum >= 5) {$old = 'лет';}
elseif ($lastNum == 1) {$old = 'год';}
elseif ($lastNum >= 2 && $lastNum <= 4) {$old = 'года';}

echo 'Мне ' . $k . ' ' . $old;

echo '<br><br>';

//В теплице стоит автоматизированная система управления климатом.
//Оперирует система двумя параметрами:
//- текущая температура $t (случайное число от -40 до 45)
//- текущая влажность $f (случайное число от 0 до 100)
//А также есть оптимальные показатели температуры $t_normal = 20 и влажности $f_normal = 50, которые должна поддерживать система.
//Система управляет следующими устройствами с различными уровнями мощности:
//- кондиционер (минимальный, умеренный, средний, максимальный);
//- конвекторный обогреватель (минимальный, умеренный, средний, максимальный);
//- система орошения (минимальный, средний, максимальный).
$br = '<br>';
$t = rand(-40 , 45);
$f = rand(0 , 100);

$dt = 20 - $t;
$df = 50 - $f;

$conditionerModeStr = '';
$heaterDtModeStr = '';
$heaterDfModeStr = '';
$irrigationModeStr = '';

if ($dt >= 1) {
    $conditionerModeStr .= '- Выкл кондиционер;';

    if ($dt > 25) {$heaterDtModeStr = '- Вкл обогреватель на максимальный уровень мощности;';}
    elseif ($dt > 15) {$heaterDtModeStr = '- Вкл обогреватель на средний уровень мощности;';}
    elseif ($dt > 8) {$heaterDtModeStr = '- Вкл обогреватель на умеренный уровень мощности;';}
    else {$heaterDtModeStr = '- Вкл обогреватель на минимальный уровень мощности;';}
} else {
    $heaterDtModeStr .= '- Выкл обогреватель;';

    if ($dt > -8) {$conditionerModeStr = '- Вкл кондиционер на минимальный уровень мощности;';}
    elseif ($dt > -15) {$conditionerModeStr = '- Вкл кондиционер на умеренный уровень мощности;';}
    elseif ($dt > -25) {$conditionerModeStr = '- Вкл кондиционер на средний уровень мощности;';}
    else {$conditionerModeStr = '- Вкл кондиционер на максимальный уровень мощности;';}
}

if ($df >= 1) {
    $heaterDfModeStr .= '- Выкл обогреватель;';

    if ($df > 25) {$irrigationModeStr .= '- Вкл орошение на максимальный уровень мощности;';}
    elseif ($df > 10) {$irrigationModeStr .= '- Вкл орошение на средний уровень мощности;';}
    else {$irrigationModeStr .= '- Вкл орошение на минимальный уровень мощности;';}
} else {
    $irrigationModeStr .= '- Выкл орошение;';

    if ($df > -10) {$heaterDfModeStr .= '- Вкл обогреватель на минимальный уровень мощности;';}
    elseif ($df > -25) {$heaterDfModeStr .= '- Вкл обогреватель на умеренный уровень мощности;';}
    else {$heaterDfModeStr .= '- Вкл обогреватель на максимальный уровень мощности;';}
}

echo 't = ' . $t . ' dt = ' . $dt . $br;
echo 'f = ' . $f . ' df = ' . $df . $br;

if ($dt >= $df) {
    echo $conditionerModeStr . $br . $irrigationModeStr . $br . $heaterDtModeStr;
} else {
    echo $conditionerModeStr . $br . $irrigationModeStr . $br . $heaterDfModeStr;
}