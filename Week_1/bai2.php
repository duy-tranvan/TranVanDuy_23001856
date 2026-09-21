<?php

$student = [
    ["name" => "Nguyen Van An", "age" => 20, "score" => 8.5],
    ["name" => "Tran Thi Binh", "age" => 21, "score" => 6.5],
    ["name" => "Le Van Cuong", "age" => 19, "score" => 4.5],
    ["name" => "Pham Thi Dung", "age" => 20, "score" => 7.5]
];

function calculateAverageScore($student){
    $sum = 0;
    foreach ($student as $s){
        $sum+=$s["score"];
    }
    return $sum/count($student);
}
function getRank($score){
    if ($score >= 8) {
        return "Giỏi";
    } elseif ($score >= 6.5) {
        return "Khá";
    } elseif ($score >= 5) {
        return "Trung bình";
    } else {
        return "Yếu";
    }
}
function displayStudent($student){
    foreach ($student as $s) {
        echo "Họ tên: " . $s["name"] . "<br>";
        echo "Tuổi: " . $s["age"] . "<br>";
        echo "Điểm: " . $s["score"] . "<br>";
        echo "Xếp loại: " . getRank($s["score"]) . "<br><br>";
    }
}
displayStudent($student);
$average = calculateAverageScore($student);
echo "Điểm trung bình: " . $average . "<br>";
?>