<?php
$servername = "localhost"; // Хост базы данных
$username = "root"; // Имя пользователя
$password = "Mysqlp@rol2001"; // Пароль
$dbname = "timetable_shaha"; // Имя базы данных

// Создаем подключение
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка подключения
if ($conn->connect_error) {
    die("Ошибка подключения к базе данных: " . $conn->connect_error);
}
?>