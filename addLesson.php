<?php
require("db_connection.php");
require_once("functions.php");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Форма для ввода данных</title>
</head>
<body>
    <h1>Введите данные:</h1>
    <form action="" method="POST">
    <label for="faculty_id">Выберите факультет:</label>
        
        <select id="faculty_id" name="faculty_id">
            <?php
            $faculty_result = get_faculties($conn);
            
            if ($faculty_result->num_rows > 0) {
                echo '<option value="" disabled selected>-Выберите факультет-</option>';
                while ($faculty_row = $faculty_result->fetch_assoc()) {
                    echo '<option value="' . $faculty_row["faculty_id"] . '">' . $faculty_row["name"] . '</option>';
                }
            }
            ?>
        </select><br><br>

        <label for="name">Имя предмета:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="code">Код урока:</label>
        <input type="text" id="code" name="code" required><br><br>

        <label for="semestr">Семестр:</label>
        <select id="semestr" name="semestr" required>
            <option value="Осень">Осень</option>
            <option value="Весна">Весна</option>
        </select><br><br>

        <label for="kredi">Сколько кредитов:</label>
        <input type="number" id="kredi" name="kredi" required><br><br>

        <label for="practice">Практика (число):</label>
        <input type="number" id="practice" name="practice" required><br><br>

        <label for="theory">Теория (число):</label>
        <input type="number" id="theory" name="theory" required><br><br>

        <input type="submit" value="Отправить">
    </form>
    <?php
        include 'add_lesson.php';
    ?>
</body>
</html>