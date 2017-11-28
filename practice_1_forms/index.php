<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>FormValidation</title>

    <style>
        body {
            max-width: 1198px;
            margin: 0 auto;
        }
        .main {
            vertical-align: top;
            display: flex;
            justify-content: space-between;

        }
        form, .main div {
            box-sizing: border-box;
            border: 1px solid black;
            border-radius: 10px;
            padding: 10px;
            background: #cecece;
        }
        input:focus {
            transform: scale(1.05);
        }
        .main div {
            margin-left: 150px;
            width: 300px;
        }
        img {
            width: 100%;
            height: 200px;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
<div class="main">
    <?php

    if (isset($_POST['send'])) {

        /**
         * Будет очищать введённые данные от ненужных и опасных символов
         * @param string $value
         * @return string
         */
        function clean($value = "") {
            $value = trim($value);
            $value = stripslashes($value);
            $value = strip_tags($value);
            $value = htmlspecialchars($value);

            return $value;
        }

        if (!empty($_POST['name'])) {
            $nameVal = clean($_POST['name']);          //прогоняем данные имени через функцию очистки
            $_POST['name'] = $nameVal;                 //перезаписываем данные имени в $_POST на очищенные данные
        }else {
            $nameErr = "Введите своё имя";}          //если имя не введено, то выдаём ошибку и ничего не записываем в имя $_POST

        if (!empty($_POST['email'])) {
            $email = clean($_POST['email']);            //прогоняем данные имейла через функцию очистки
            $emailFilter = filter_var($email, FILTER_VALIDATE_EMAIL); //фильтруем данные имейла по необходимым параметрам
            if ($emailFilter == true) {                  //если данные после фильтра валидные, то переводим данные в нижний регистр
                $emailVal = $emailFilter;                //(вдруг они были введены в верхнем регистре) и перезаписываем данные в $_POST
                $emailVal = strtolower($emailVal);
                $_POST['email'] = $emailVal;
            } else {
                $emailErr = "Введите правильный адрес электронной почты";} //выводим ошибку в случае неправильного ввода
        }else {
            $emailErr = "Введите адрес электронной почты";} //выводим ошибку в случае отсутствия ввода данных

        if (!empty($_POST['login']))  {
            $login = clean($_POST['login']);
            if (preg_match("/^[\da-zA-Z_]{4,30}$/", $login) == true) { //всё аналогично предыдущим проверкам
                $loginVal = $login;
                $_POST['login'] = $loginVal;
            } else {
                $loginErr = "Введите логин в соответствии с требованиями";}
        }else {
            $loginErr = "Ведите логин";}

        if (!empty($_POST['password']))  {
            $password = clean($_POST['password']);
            if (preg_match("/^[\da-zA-Z_]{3,10}$/", $password) == true) { //всё аналогично предыдущим проверкам
                $passwordVal = $password;
                $_POST['password'] = $passwordVal;
            } else {
                $passwordErr = "Введите пароль в соответствии с требованиями";}
        }else {
            $passwordErr = "Ведите пароль";}

        if (!empty($_POST['date']))  {                     // проверка ввода даты
            $date = $_POST['date'];
        }else {
            $dateErr = "Ведите дату своего рождения";}

        if (!empty($_FILES)) {                             // если добавили файл и он отвечает требованиям, то сохраняем его
            if ($_FILES['file']['type'] == 'image/jpeg' && $_FILES['file']['size'] < 5242880) {
                move_uploaded_file($_FILES['file']['tmp_name'], 'uploaded/' . $_FILES['file']['name']);
            } else {
                $fileErr = 'Неверный файл';}
        }

        if ($nameVal && $emailVal && $loginVal && $passwordVal && $_POST['date']) {  // если введены все данные и они отвечают всем требованиям, то заполняем их в файл (импровизированную базу данных)
            $file = 'database.txt';
            $text = "Полученные данные. Имя: " .$nameVal. "; e-mail: " .$emailVal. "; Логин: " .$loginVal. "; Пароль: " .$passwordVal. "; Дата рождения: " .$date;
            file_put_contents($file, $text, FILE_APPEND | LOCK_EX);
        }
    }
    ?>
    <form method="post" action="" enctype="multipart/form-data">
        <p>
            Ведите имя: <input type="text" name="name"><span class="error"><?php echo $nameErr ?></span>
        </p>
        <p>
            Введите e-mail: <input type="email" name="email"><span class="error"><?php echo $emailErr ?></span>
        </p>
        <p>
            Введите логин: <input type="text" name="login"><span class="error"><?php echo $loginErr ?></span>
        </p>
        <p>
            Введите пароль: <input type="password" name="password"><span class="error"><?php echo $passwordErr ?></span>
        </p>
        <p>
            Выберите дату рождения: <input type="date" name="date"><span class="error"><?php echo $dateErr ?></span>
        </p>
        <p>
            Загрузить аватар: <input type="file" name="file"><span class="error"><?php echo $fileErr ?></span>
        </p>
        <p>
            <input type="submit" name="send">
        </p>
    </form>
    <div>
        <?php
        if (!$_FILES || $_FILES['file']['error'] == 4) {         //если файл добавлен, но меняем аватарку, а если нет, то
            echo "<img src='uploaded/images.jpg'>";              //оставляем дефолтное изображение
        } else {
        echo "<img src=uploaded/" .$_FILES['file']['name'].">";
        }

        ?>
        <br>
        <?php
        if ($nameVal && $emailVal && $loginVal && $passwordVal && $_POST['date']) {
            echo "Имя: " .$nameVal. "; <br> e-mail: " .$emailVal. "; <br> Логин: " .$loginVal. "; <br> Дата рождения: " .$date.".";
        } else {
            echo "Имя: ; <br> e-mail: ; <br> Логин: ; <br> Дата рождения: ;";}

        ?>
    </div>
</div>
<hr>
<h2>Info from PHP</h2>

    <?php
    if (isset($_POST['send'])) {
        echo "<pre>";
        print_r($_POST);
        echo "<pre>";
    }

    if (!empty($_FILES)) {
        echo "<pre>";
        print_r($_FILES);
        echo "</pre>";
    }
    ?>


</body>
</html>