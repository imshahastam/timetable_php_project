<?php
require("db_connection.php");
require_once("functions.php");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Выбор факультета и предмета</title>
    <script>
        function passFaculty() {
            // Получите выбранный факультет из первой формы
            var selectedFaculty = document.getElementById("faculty").value;
            
            // Передайте его в скрытое поле второй формы
            document.getElementById("selectedFaculty").value = selectedFaculty;
            
            // Отправьте вторую форму
            document.forms["form2"].submit();
        }
    </script>
</head>
<body>
    <h1>Выбор факультета и предмета</h1>

    <form action="form2.php" method="post" id="form1">
        <label for="faculty">Факультет:</label>
        <select id="faculty" name="faculty">
            <?php
            $faculty_result = get_faculties($conn);

            if ($faculty_result->num_rows > 0) {
                while ($faculty_row = $faculty_result->fetch_assoc()) {
                     echo '<option value="' . $faculty_row["name"] . '">' . $faculty_row["name"] . '</option>';
                }
            }
            ?>
        </select>
        <br><br>

        <!-- Скрытое поле для передачи выбранного факультета -->
        <input type="hidden" id="selectedFaculty" name="selectedFaculty">

        <!-- Кнопка для передачи выбранного факультета во вторую форму -->
        <input type="button" value="Выбрать предмет" onclick="passFaculty()">
    </form>

    <form action="form3.php" method="post" id="form2">
        <label for="subject">Предмет:</label>
        <select id="subject" name="subject">
            <?php
            // Получите выбранный факультет из скрытого поля
            $selectedFaculty = isset($_POST["selectedFaculty"]) ? $_POST["selectedFaculty"] : "";

            // Здесь вывести предметы из базы данных, соответствующие выбранному факультету
            // Пример:
            $subject_result = get_lessons_by_faculty($conn, $selectedFaculty);

                if ($subject_result->num_rows > 0) {
                    while ($subject_row = $subject_result->fetch_assoc()) {
                        echo '<option value="' . $subject_row["name"] . '">' . $subject_row["name"] . '</option>';
                    }
                }
            ?>
        </select>
        <br><br>
        <!-- Вторая форма для выбора предмета -->

        <input type="submit" value="Сохранить">
    </form>
</body>
</html>
