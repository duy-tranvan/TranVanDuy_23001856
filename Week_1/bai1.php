<?php

$student = [
    ["name" => "Nguyen Van An", "age" => 20, "score" => 8.5],
    ["name" => "Tran Thi Binh", "age" => 21, "score" => 6.5],
    ["name" => "Le Van Cuong", "age" => 19, "score" => 4.5],
    ["name" => "Pham Thi Dung", "age" => 20, "score" => 7.5]
];

$sum = 0;

foreach ($student as $s) {
    echo "Họ tên: " . $s["name"] . "<br>";
    echo "Tuổi: " . $s["age"] . "<br>";
    echo "Điểm: " . $s["score"] . "<br><br>";
    $sum += $s["score"];
}

$average = $sum / count($student);
echo "Điểm trung bình: " . $average . "<br>";

?>