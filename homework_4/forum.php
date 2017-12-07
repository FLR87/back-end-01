<link rel="stylesheet" href="styles.css">

<?php
    require_once 'connect.php';

    $messages = getQuery();

    foreach($messages as $message) {
        echo "<div class='forum_item'>
                    <p class='forum_item_author'>Автор: ".$message['email']."</p>
                    <p class='forum_item_message'>Сообщение: ".$message['text']."</p>
            </div>";
    }
?>
<a href="index.php" class="forum_adder">Добавить комментарий</a>
