<?php

$student = [
    ["name" => "Nguyen Van An", "age" => 20, "score" => 8.5],
    ["name" => "Tran Thi Binh", "age" => 21, "score" => 6.5],
    ["name" => "Le Van Cuong", "age" => 19, "score" => 4.5],
    ["name" => "Pham Thi Dung", "age" => 20, "score" => 7.5]
];

function findBestStudent($student){
    $bestStudent = $student[0];
    $highestScore = $student[0]["score"];

    foreach ($student as $s) {
        if ($s["score"] > $highestScore) {
            $highestScore = $s["score"];
            $bestStudent = $s;
        }
    }

    return $bestStudent;
}

function findWorstStudent($student){
    $worstStudent = $student[0];
    $lowestScore = $student[0]["score"];

    foreach ($student as $s) {
        if ($s["score"] < $lowestScore) {
            $lowestScore = $s["score"];
            $worstStudent = $s;
        }
    }

    return $worstStudent;
}

function countPassedStudents($student){
    $count = 0;

    foreach ($student as $s){
        if ($s["score"] >= 5) {
            $count++;
        }
    }

    return $count;
}

function findStudentByName($students, $name){
    foreach ($students as $student) {
        if ($student["name"] === $name) {
            return $student;
        }
    }

    return null;
}

echo "Sinh viên có điểm cao nhất: ";
print_r(findBestStudent($student));

echo "<br><br>";

echo "Sinh viên có điểm thấp nhất: ";
print_r(findWorstStudent($student));

echo "<br><br>";

echo "Số lượng sinh viên đạt: ";
echo countPassedStudents($student);

echo "<br><br>";

echo "Tìm Le Van Cuong: ";
print_r(findStudentByName($student, "Le Van Cuong"));

echo "<br><br>";

echo "Tìm Nguyen Van An: ";
print_r(findStudentByName($student, "Nguyen Van An"));

?>