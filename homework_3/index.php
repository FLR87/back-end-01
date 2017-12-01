<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HomeWork3</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<form action="action.php" method="post" enctype="multipart/form-data">
    <p>
        E-mail: <input class="email" type="email" name="email" placeholder="Введите свой e-mail" required>
    </p>
    <p>
        Сообщение: <textarea name="textarea" maxlength="200" placeholder="Введите сообщение" required></textarea>
    </p>
    <p>
        <input class="file_input" type="file" name="file">
    </p>
    <p>
        <input class="submit" type="submit" name="send">
    </p>
</form>
</body>
</html>

<?php
// 1
const MNTH = 'Май';
/**
 * Заполните массив месяцами ['Янаварь','Февраль',.......]
Выведите нужный месяц из массива используя для проверки контанту.
 */
function favoriteMonth() {
    $months = ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'];
    foreach ($months as $month) {
        if ($month == MNTH) {
            echo $month;
        }
    }
}
//favoriteMonth();
echo "<br>";

//2
/**
 * Используя цикл for() заполните массив  100 числами в диапазоне от 0-9
Используя цикл foreach() запишите ЧЕРЕЗ ОДНО эти числа в файл и затем выведите на экран.
 */
function filteredArrayInFile() {
    $integers = [];
    for($i=0; $i <= 100; $i++) {
        $integers[$i] = rand(0,9);
    }

    foreach($integers as $key => $integer) {
        if ($key % 2 == 0) {
            $text = "Число: " .$integers[$key]. "; ";
            file_put_contents('numbers.txt', $text, FILE_APPEND | LOCK_EX);
        }
    }
    echo file_get_contents('numbers.txt');
}
//filteredArrayInFile();
?>