<?php
    include("db_connection.php");
    if(isset($_POST['submit_all'])) {
        $subject = $_POST["subject"];
        $teacher = $_POST["teacher"];
        $day = $_POST["day"];
        $time = $_POST["time"];
        $lesson_id = null;

        $lesson_id = mysqli_query($conn, "SELECT lesson_id FROM lessons WHERE name = '$subject'");

        $query = mysqli_query($conn, "UPDATE lessons SET teacher = '$teacher', times = '$time', days = '$day' 
        WHERE lesson_id = $lesson_id");

        if($query) {
            echo "<script>alert('done')</script>";
        } else {
            echo "<script>alert('error')</script>";
        }
    }
?>
