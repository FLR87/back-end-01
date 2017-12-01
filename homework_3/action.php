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
    $error = [];

    if (!empty($_POST['email'])) {
        $email = clean($_POST['email']);
        $emailFilter = filter_var($email, FILTER_VALIDATE_EMAIL);
        if ($emailFilter == true) {
            $emailVal = $emailFilter;
            $emailVal = strtolower($emailVal);
            $_POST['email'] = $emailVal;
        } else {
            $error['email'] = "Введите правильный адрес электронной почты";}
    }

    if (!empty($_POST['textarea'])) {
        $textareaVal = clean($_POST['textarea']);
    }

    if (!empty($_FILES)) {
        if ($_FILES['file']['size'] < 10485760) {
            move_uploaded_file($_FILES['file']['tmp_name'], 'uploaded/' . $_FILES['file']['name']);
        } else {
            $error['file'] = 'Размер файла не должен превышать 10МБ';}
    }
}
?>

<link rel="stylesheet" href="style.css">
<div class="form_action">
    <div class="form_action_inner">
        <?php if ($emailVal) {  // если введены все данные и они отвечают всем требованиям, то заполняем их в файл (импровизированную базу данных)
            $file = $emailVal.'.txt';
            $text = "Получено сообщение. Адресант: " .$emailVal. "; Сообщение: " .$textareaVal. "; Файл: " .$_FILES['file']['name'];
            file_put_contents($file, $text, FILE_APPEND | LOCK_EX);
            echo "Ваше сообщение успешно отправлено!";
            echo "<br>";
            echo "<a href='index.php'>Отправить ещё одно сообщение</a>";
        } else {
            echo "Ошибка: ".$error['email']." ".$error['file'];
            echo "<br>";
            echo "<a href='index.php'>Отправить сообщение повторно</a>";
        }
        ?>
    </div>
</div>
