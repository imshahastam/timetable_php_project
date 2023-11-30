<?php
// Подключаем файл с настройками базы данных
require_once("db_connection.php");
echo '<pre>';
        var_dump($_POST);
        echo '</pre>';
// Получение данных из формы
$faculty_id = $_POST["faculty_id"];
$name = $_POST["name"];
$code = $_POST["code"];
$semestr = $_POST["semestr"];
$kredi = $_POST["kredi"];
$practice = $_POST["practice"];
$theory = $_POST["theory"];

// SQL-запрос для вставки данных в базу данных
$sql = "INSERT INTO lessons (faculty_id, name, code, semestr, kredi, theory, practice) 
VALUES ('$faculty_id', '$name', '$code', '$semestr', $kredi, $theory, $practice)";

// Выполнение SQL-запроса
if ($conn->query($sql) === TRUE) {
    echo "Данные успешно добавлены в базу данных.";
} else {
    echo "Ошибка: " . $sql . "<br>" . $conn->error;
}

// Закрытие соединения с базой данных
$conn->close();
?>