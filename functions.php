<?php

function get_faculties($conn) {
    $faculties_sql = "SELECT faculty_id, name FROM faculties";
    $result = $conn->query($faculties_sql);

    return $result;
}

function get_lessons($conn) {
    $lessons_sql = "SELECT lesson_id, name FROM lessons";
    $result = $conn->query($lessons_sql);

    return $result;
}

function get_days($conn) {
    $days_sql = "SELECT day_id, name FROM days";
    $result = $conn->query($days_sql);

    return $result;
}

function get_times($conn) {
    $times_sql = "SELECT time_id, time FROM times";
    $result = $conn->query($times_sql);

    return $result;
}

function get_lessons_by_faculty($conn, $faculty_name) {
    $lessons_sql = "SELECT l.name, l.lesson_id FROM lessons l INNER JOIN faculties f ON
    (l.faculty_id = f.faculty_id) WHERE f.name = '$faculty_name'";
    $result = $conn->query($lessons_sql);

    return $result;

    // echo '<pre>';
    // var_dump($result);
    // echo '</pre>';
}
