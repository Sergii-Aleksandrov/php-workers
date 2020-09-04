<?php
/*
//    Основы работы с PHP. Урок#1
$var = 'abcde';
echo $var[1];
echo $var[3];
echo $var[4];

echo 60 * 60;

$var = 1;
$var += 12;
$var -= 14;
$var *= 5;
$var /= 7;
$var += 1;
$var -= 1;
echo $var;

//1
$a = 3;
echo $a;

//2
$a = 10;
$b = 2;
echo $a + $b;
echo $a - $b;
echo $a * $b;
echo $a / $b;

//3
$a = 15;
$b = 2;
$result = $a + $b;
echo $result;

//4
$a = 10;
$b = 2;
$c = 5;
echo $a + $b + $c;

//5
$a = 17;
$b = 10;
$c = $a - $b;
$d = 7;
$result = $c + $d;
echo $result;

//Работа со строками
$text = 'Hello World';
echo $text;

//7
$text1 = 'Hello, ';
$text2 = 'World';
echo $text1.$text2;

//8
$name = 'Sergii';
echo 'Hello, '.$name;

//9
$age = 33;
echo "I'm ".$age.' years.';

//Обращение к символам строки
$text = 'abcde';
echo $text[0];
echo $text[2];
echo $text[4];

//11
$text = 'abcde';
$text[0] = '!';
echo $text;

//12
$num = '12345';
echo $num[0] + $num[1] + $num[2] + $num[3] + $num[4];

//Практика
echo 60 * 60;
echo 60 * 60 * 24;
echo 60 * 60 * 24 * 31;

//14
$hours = '08';
$min = '10';
$sec = '40';
echo $hours.':'.$min.':'.$sec;

//15
$num = 5;
echo $num *= $num;

//Работа с присваиванием и декрементами
$num = 47;
$num += 7;
$num -= 18;
$num *= 10;
$num /= 20;
echo $num;

//17
$text = 'I';
$text .= ' want to ';
$text .= ' know ';
$text .= 'PHP.';
echo $text;

//18
$num = 10;
$num++;
$num++;
$num--;
echo $num;

//19
$num = 10;
$num += 7;
$num++;
$num--;
$num += 12;
$num *= 7;
$num -= 15;
echo $num;
*/

/*
//Основы работы с массивами в PHP
//1
$arr = array('a', 'b', 'c');
var_dump($arr);

//2
echo $arr[0];
echo $arr[1];
echo $arr[2];

//3
$arr = array('a', 'b', 'c', 'd');
echo $arr[0].'+'.$arr[1].', '.$arr[2].'+'.$arr[3];

//4
$arr = array(2, 5, 3, 9);
$result = $arr[0] * $arr[1] + $arr[2] * $arr[3];
echo $result;

//5
$arr1[] = 1;
$arr1[] = 2;
$arr1[] = 3;
$arr1[] = 4;
$arr1[] = 5;
var_dump($arr1);

//Ассоциативные массивы
$arr = array('a'=>1, 'b'=>2, 'c'=>3);
echo $arr['c'];

//7
$arr = array('a'=>1, 'b'=>2, 'c'=>3);
echo $arr['a'] + $arr['b'] + $arr['c'];

//8
$arr = array('Коля'=>'1000$', 'Вася'=>'500$', 'Петя'=>'200$');
echo $arr['Коля'];
echo $arr['Петя'];

//9
$arr = array('1'=> 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб', 'Вс');
echo $arr[3];

//10
$day = 5;
echo $arr[$day];

//Многомерные массивы
$arr = array(
    'cms' => array('joomla', 'wordpress', 'drupal'),
    'colors' => array('blue' => 'голубой', 'red' => 'красный', 'green' => 'зеленый'),
);
echo $arr['cms'][0];
echo $arr['cms'][2];
echo $arr['colors']['green'];
echo $arr['colors']['red'];

//12
$arr = array(
    'ru' => array('1'=> 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб', 'Вс'),
    'en' => array('1'=> 'Pn', 'Vt', 'Sr', '4t', 'Pt', 'Sb', 'Vs'),
);
echo $arr['ru'][1];
echo $arr['en'][3];

//13
$arr = array(
    'ru' => array('1'=> 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб', 'Вс'),
    'en' => array('1'=> 'Pn', 'Vt', 'Sr', '4t', 'Pt', 'Sb', 'Vs'),
);
$lang = 'en';
$day = 3;
echo $arr[$lang][$day];
*/
/*
var_dump($_POST);
echo '<form method="post">
<input type="text" name="test" value="123">
<button type="submit">go</button>
</form>';
*/

/*
//Работа с конструкциями if-else, switch-case в PHP
$a = -3;
if ($a == 0){
    echo 'true';
} else {
    echo 'false';
}

//2
$a = 3;
if ($a > 0) {
    echo 'true';
} else {
    echo 'false';
}

//3
$a = -3;
if ($a < 0) {
    echo 'true';
} else {
    echo 'false';
}

//4
$a = -3;
if ($a >= 0) {
    echo 'true';
} else {
    echo 'false';
}

//5
$a = -3;
if ($a <= 0) {
    echo 'true';
} else {
    echo 'false';
}

//6
$a = '3';
if ($a != 0) {
    echo 'true';
} else {
    echo 'false';
}

//7
$a = 'test';
if ($a == 'test') {
    echo 'true';
} else {
    echo 'false';
}

//8
$a = '-1';
if ($a === '1') {
    echo 'true';
} else {
    echo 'false';
}

//Работа с empty и isset
$a = 'null';
if (empty($a)) {
    echo 'true';
} else {
    echo 'false';
}

//10
$a = null;
if (!empty($a)) {
    echo 'true';
} else {
    echo 'false';
}

//11
$a = null;
if (isset($a)) {
    echo 'true';
} else {
    echo 'false';
}

//12
$a = 3;
if (!isset($a)) {
    echo 'true';
} else {
    echo 'false';
}

//Работа с логическими переменными
$a = false;
if ($a) echo 'true'; else echo 'false';

//14
$a = false;
if (!$a) echo 'true'; else echo 'false';

//Работа с OR и AND
$a = -3;
if ($a > 0 and $a < 5) {
    echo 'true';
} else {
    echo 'false';
}

//16
$a = 0;
if ($a == 0 or $a == 2) {
    echo $a + 7;
} else {
    echo $a / 10;
}

//17
$a = 3;
$b = 5;
if ($a <= 1 and $b >= 3) {
    echo $a + $b;
} else {
    echo $a - $b;
}

//18
$a = -5;
$b = -8;
if ($a > 2 and $a < 11 or $b >= 6 and $b < 14) {
    echo 'true';
} else {
    echo 'false';
}

//На switch-case
$num = 4;
switch ($num) {
    case 1: echo 'зима';
        break;
    case 2: echo 'весна';
        break;
    case 3: echo 'лето';
        break;
    case 4: echo 'осень';
        break;
}

//Задачи
$day = 10;
if ($day >= 1 and $day <=9) {
    echo 'one';
} elseif ($day >= 10 and $day <= 19) {
    echo 'tu';
} elseif ($day >= 20 and $day <= 31) {
    echo 'fri';
}
*/
//21
$month = 3;
if (($month >= 1 and $month <=2) or $month == 12) {
    echo 'зима';
} elseif ($month >= 3 and $month <= 5) {
    echo 'весна';
} elseif ($month >= 6 and $month <= 8) {
    echo 'лето';
} elseif ($month >= 9 and $month <= 11) {
    echo 'осень';
}
