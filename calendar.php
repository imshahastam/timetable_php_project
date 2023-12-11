<?php
include 'db_connection.php';

$times = ['8:00', '8:55', '9:50', '10:45', '11:40', '13:30', '14:25', '15:20', '16:15', '17:10'];
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Table</title>
    <link href="calendar.css" rel="stylesheet" type="text/css">
</head>
<body>
    <h2>Таблица расписания</h2>
    <table class = "table" border="1">
        <tr>
            <th>Время</th>
            <th>Понедельник</th>
            <th>Вторник</th>
            <th>Среда</th>
            <th>Четверг</th>
            <th>Пятница</th>
        </tr>
        <?php
        $selectedFaculty = $_POST["faculty"];
        $selectedCourse = $_POST["course"];
        foreach ($times as $index => $time) {
            echo "<tr>
                    <td class='td_time'>{$time}</td>";
    
            // Для каждого дня недели делаем запрос и выводим соответствующий предмет
            for ($day_id = 1; $day_id <= 5; $day_id++) {
                $sql_day = "SELECT l.name, t.full_name, class.number FROM calendar c
                            INNER JOIN lessons l ON c.lesson_id = l.lesson_id
                            INNER JOIN teachers t ON c.teacher_id = t.teacher_id
                            INNER JOIN classrooms class ON c.classroom_id = class.classroom_id
                            INNER JOIN faculties f ON l.faculty_id = f.faculty_id
                            WHERE c.day_id = $day_id AND c.time_id = $index+1
                            AND l.faculty_id = $selectedFaculty AND l.code LIKE '___-$selectedCourse%__'";
    
                $result_day = $conn->query($sql_day);
    
                if ($row = $result_day->fetch_assoc()) {
                    echo "<td>{$row['name']} <br> {$row['full_name']} <br> {$row['number']}</td>";
                } else {
                    echo "<td></td>"; // Если нет данных, можно выводить что-то по умолчанию
                }
            }
    
            echo "</tr>";
        }
        
        ?>
    </table>
</body>
</html>

<?php
$conn->close();
?>
