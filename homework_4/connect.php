<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'joins');

$mysqli = @new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if ($mysqli->connect_errno) {
    exit('Ошибка соединения с БД');
}
$mysqli->set_charset('utf8');


function insertQuery() {
    global $mysqli;
    global $emailVal;
    global $textareaVal;
    $emailVal = mysqli_real_escape_string($mysqli, $emailVal);
    $textareaVal = mysqli_real_escape_string($mysqli, $textareaVal);
    $fileName = $_FILES['file']['name'];
    $query = "INSERT INTO messages (email, text, file) VALUES ('$emailVal', '$textareaVal', '$fileName')";
    mysqli_query($mysqli, $query);

};

function getQuery() {
    global $mysqli;
    $query = "SELECT * FROM messages ORDER BY mes_id DESC";
    $res = mysqli_query($mysqli, $query);
    return mysqli_fetch_all($res, MYSQLI_ASSOC);
};





//$mysqli->close();
?>