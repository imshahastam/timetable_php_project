<?php
    include("db_connection.php");

    echo '<pre>';
    var_dump($_POST);
    echo '</pre>';

    $lesson_id = mysqli_real_escape_string($conn, $_POST['subject']);
    $teacher = $_POST["teacher"];
    $day = $_POST["day"];
    $time = $_POST["time"];

    $query = mysqli_query($conn, "UPDATE lessons SET teacher = '$teacher', times = '$time', days = '$day' 
    WHERE lesson_id = $lesson_id");

    if($query) {
        echo "<script>alert('done')</script>";
    } else {
        echo "Ошибка выполнения запроса: " . mysqli_error($conn);
    }                   
?>
