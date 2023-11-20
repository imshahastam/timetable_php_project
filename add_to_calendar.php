<?php
    include("db_connection.php");

        $subject = $_POST["subject"];
        $teacher = $_POST["teacher"];
        $day = $_POST["day"];
        $time = $_POST["time"];
        $lesson_id = null;

        //$lesson_id_query = mysqli_query($conn, "SELECT lesson_id FROM lessons WHERE name = '$subject'");
        $lesson_id_query = "SELECT lesson_id FROM lessons WHERE name = '$subject'";
        $result = $conn->query($lesson_id_query);
        if($result) {
            //$row = mysqli_fetch_assoc($lesson_id_query);
            $row = $result->fetch_assoc();
            $lesson_id = $row['lesson_id'];

            $query = mysqli_query($conn, "UPDATE lessons SET teacher = '$teacher', times = '$time', days = '$day' 
            WHERE lesson_id = $lesson_id");

            if($query) {
                echo "<script>alert('done')</script>";
            } else {
                echo "Ошибка выполнения запроса: " . mysqli_error($conn);
            }
        } else {
            echo "Ошибка выполнения запроса: " . mysqli_error($conn);
        }
?>
