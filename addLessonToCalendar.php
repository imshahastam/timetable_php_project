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
                echo '<option value="" disabled selected>-Выберите факультет-</option>';
                while ($faculty_row = $faculty_result->fetch_assoc()) {
                    echo '<option value="' . $faculty_row["name"] . '">' . $faculty_row["name"] . '</option>';
                }
            }
            ?>
        </select><br><br>
        <input type="submit" value="Выбрать факультет">
    </form>

    <form action="add_to_calendar.php" method="POST">
        <label for='subject'>Выберите предмет:</label>
            <select name='subject' id='subject'>
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["faculty"])) {
                    // Получение выбранного факультета
                    $selectedFaculty = $_POST["faculty"];

                    $result = get_lessons_by_faculty($conn, $selectedFaculty);

                    while ($row = $result->fetch_assoc()) {
                ?>      
                <option value="<?php echo $row['lesson_id'];?>">
                <?php echo $row['name']; ?>
                </option> <?php
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
            <option value="1">Понедельник</option>
            <option value="2">Вторник</option>
            <option value="3">Среда</option>
            <option value="4">Четверг</option>
            <option value="5">Пятница</option>
        </select><br><br>

        <label for="time">Время:</label>
        <select id="time" name="time">
            <option value="1">8:00</option>
            <option value="2">8:55</option>
            <option value="3">9:50</option>
            <option value="4">10:45</option>
            <option value="5">11:40</option>
            <option value="6">13:30</option>
            <option value="7">14:25</option>
            <option value="8">15:20</option>
            <option value="9">16:15</option>
            <option value="10">17:10</option>
        </select><br><br>
        <input type='submit' value="Записать в расписание">
    </form>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){

            $()
        }) 
    </script>
</body>
</html>

