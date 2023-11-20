<?php
require("db_connection.php");
require_once("functions.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Записать в расписание</title>
</head>
<body>
    <h1>Запишите в расписание</h1>
    <form action="" method="post">
        <label for="faculty">Выберите факультет:</label>
        <select id="faculty" name="faculty">
            <?php
            $faculty_result = get_faculties($conn);

            if ($faculty_result->num_rows > 0) {
                while ($faculty_row = $faculty_result->fetch_assoc()) {
                    echo '<option value="' . $faculty_row["name"] . '">' . $faculty_row["name"] . '</option>';
                }
            }
            ?>
        </select><br><br>
        <input type="submit" value="Выбрать факультет">
    </form>

    <?php
    session_start();

    // Проверка, была ли отправлена форма
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["faculty"])) {
        // Получение выбранного факультета
        $selectedFaculty = $_POST["faculty"];

        // Запись текста и времени его появления в сессию
        $_SESSION["selectedFacultyText"] = "Выбранный факультет: $selectedFaculty";
        $_SESSION["selectedFacultyTime"] = time(); // Записываем текущее время
    }

    // Проверка, есть ли текст в сессии и прошло ли более двух минут
    if (isset($_SESSION["selectedFacultyText"]) && isset($_SESSION["selectedFacultyTime"]) && (time() - $_SESSION["selectedFacultyTime"] < 5)) {
        echo "<span style='color: green;'>" . $_SESSION["selectedFacultyText"] . "</span>";
    }
    ?>


    <form action="add_to_calendar.php" method="POST">
        <label for='subject'>Выберите предмет:</label>
            <select name='subject' id='subject'>
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["faculty"])) {
                    // Получение выбранного факультета
                    $selectedFaculty = $_POST["faculty"];

                    $result = get_lessons_by_faculty($conn, $selectedFaculty);

                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                    }
                    // Закрытие соединения с базой данных
                    $conn->close();
                }
                ?>
        </select><br><br>

        <label for="teacher">Преподаватель:</label>
        <input type="text" id="teacher" name="teacher" required><br><br>

        <label for="day">День недели:</label>
        <select id="day" name="day">
            <option value="ПН">Понедельник</option>
            <option value="ВТ">Вторник</option>
            <option value="СР">Среда</option>
            <option value="ЧТ">Четверг</option>
            <option value="ПТ">Пятница</option>
        </select><br><br>

        <label for="time">Время:</label>
        <select id="time" name="time">
            <?php
            $start_time = strtotime("08:00");
            $end_time = strtotime("18:00");
            $break_start = strtotime("12:30");
            $break_end = strtotime("13:30");
            $interval = 45 * 60; // 45 минут в секундах
            $break_interval = 10 * 60; // 10 минут перерыв

            for ($time = $start_time; $time < $end_time; $time += $interval+$break_interval) {
                $time_str = date("H:i", $time);
                if ($time < $break_start || $time >= $break_end) {
                    echo '<option value="' . $time_str . '">' . $time_str . '</option>';
                }
            }
            ?>
        </select><br><br>
        <input type='submit' value="Записать в расписание">
    </form>
</body>
</html>

