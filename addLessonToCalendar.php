<?php
require("db_connection.php");
require_once("functions.php");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Расписание</title>
</head>
<body>
    <h1>Запись в расписание</h1>
    <form id="formForFaculty" method="GET">
        <label for="faculty_label">Факультет:</label>
        <select id="faculty" name="faculty">
            <?php
            $faculty_result = get_faculties($conn);

            if ($faculty_result->num_rows > 0) {
                while ($faculty_row = $faculty_result->fetch_assoc()) {
                     $selected_faculty = '<option value="' . $faculty_row["name"] . '">' . $faculty_row["name"] . '</option>';
                     echo $selected_faculty;
                }
            }
            ?>
        </select><br><br>
    </form>

    <form id="formForSubject" action="" method="POST">
        <label for="name">Предмет:</label>
        <select id="name" name="name">
            <?php
            // Здесь предметы будут выбраны на основе выбранного факультета
            
                $subject_result = get_lessons_by_faculty($conn, $selected_faculty);

                if ($subject_result->num_rows > 0) {
                    while ($subject_row = $subject_result->fetch_assoc()) {
                        echo '<option value="' . $subject_row["name"] . '">' . $subject_row["name"] . '</option>';
                    }
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

        <input type="submit" value="Записать в расписание">
    </form>
</body>
</html>