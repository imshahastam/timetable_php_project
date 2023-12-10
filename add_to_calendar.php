<?php
    include("db_connection.php");

    echo '<pre>';
    var_dump($_POST);
    echo '</pre>';

    $lesson_id = mysqli_real_escape_string($conn, $_POST['subject']);
    $teacher_id = $_POST["teacher"];
    $classroom_id = 1;
    $day_id = $_POST["day"];
    $time_id = $_POST["time"];

    //$query = mysqli_query($conn, "UPDATE lessons SET teacher = '$teacher', times = '$time', days = '$day' 
    //WHERE lesson_id = $lesson_id");

    $query = mysqli_query($conn, "INSERT INTO calendar (lesson_id, teacher_id, classroom_id, day_id, time_id)
    VALUES ($lesson_id, $teacher_id, $classroom_id, $day_id, $time_id)");

    if($query) {
        echo "<script>alert('done')</script>";
    } else {
        echo "Ошибка выполнения запроса: " . mysqli_error($conn);
    }                 
?>
