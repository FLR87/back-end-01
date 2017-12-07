<?php
require_once 'connect.php';

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

<link rel="stylesheet" href="styles.css">
<div class="form_action">
    <div class="form_action_inner">
        <?php if (!$error) {  // если введены все данные и они отвечают всем требованиям, то заполняем их в базу данных
            insertQuery();
            echo "Ваше сообщение успешно отправлено!";
            echo "<br>";
            echo "<a href='index.php'>Отправить ещё одно сообщение</a>";
        } else {
            echo "Ошибка: ".$error['email']." ".$error['file'];
            echo "<br>";
            echo "<a href='index.php'>Отправить сообщение повторно</a>";
        }
        ?>
        <a href="forum.php" class="forum_link">Перейти на форум</a>
    </div>
</div>
