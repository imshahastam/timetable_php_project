<?php
require("db_connection.php");
require_once("functions.php");

echo '<pre>';
var_dump($_POST);
echo '</pre>';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Расписание</title>
</head>
<body>
    <h1>Расписание</h1>
    <form action="" method="post">
        <label for="faculty">Выберите факультет:</label>
        <select id="faculty" name="faculty">
            <?php
            $faculty_result = get_faculties($conn);

            if ($faculty_result->num_rows > 0) {
                while ($faculty_row = $faculty_result->fetch_assoc()) {
                    echo '<option value="' . $faculty_row["faculty_id"] . '">' . $faculty_row["name"] . '</option>';
                }
            }
            ?>
        </select>

        <label for="course">Курс:</label>
        <select id="course" name="course">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
        </select>
        <input type="submit" value="✅">
    </form>

    <?php
        include 'calendar.php';
    ?>
</body>
</html>