<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HomeWork4</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<form action="action.php" method="post" enctype="multipart/form-data">
    <h2>Добавьте свой комментарий на форуме</h2>
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
    <a href="forum.php" class="forum_link">Перейти на форум</a>
</form>

</body>
</html>

