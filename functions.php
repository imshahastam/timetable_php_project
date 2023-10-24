<?php

function get_faculties($conn) {
    $faculties_sql = "SELECT name FROM faculties";
    $result = $conn->query($faculties_sql);

    return $result;
}

function get_lessons_by_faculty($conn, $faculty_name) {
    //print_r($faculty_name);
    $lessons_sql = "SELECT l.name FROM lessons l INNER JOIN faculties f ON
    (l.faculty_id = f.faculty_id) WHERE f.name = '$faculty_name'";
    $result = $conn->query($lessons_sql);
    //print_r($result);

    return $result;

    // echo '<pre>';
    // var_dump($result);
    // echo '</pre>';
}
//get_lessons_by_faculty($conn, 'UME');
