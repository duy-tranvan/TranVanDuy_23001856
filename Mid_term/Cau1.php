<?php
function xepLoai($name, $score) {
    if (!is_string($name) || trim($name) === "") {
        throw new InvalidArgumentException("Tên học sinh không được để trống.");
    }

    if (!is_numeric($score)) {
        throw new InvalidArgumentException("Điểm phải là một số.");
    }

    $score = (float) $score;

    if ($score < 0 || $score > 10) {
        throw new RangeException("Điểm phải nằm trong khoảng từ 0 đến 10.");
    }

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

$name  = "Nguyễn Văn An";
$score = 7.5;

try {
    $rank = xepLoai($name, $score);

    echo "Tên học sinh: " . $name . "<br>";
    echo "Điểm: " . $score . "<br>";
    echo "Xếp loại: " . $rank . "<br>";
} catch (InvalidArgumentException $e) {
    echo "Lỗi dữ liệu đầu vào: " . $e->getMessage() . "<br>";
} catch (RangeException $e) {
    echo "Lỗi giá trị điểm: " . $e->getMessage() . "<br>";
} catch (Exception $e) {
    echo "Đã xảy ra lỗi: " . $e->getMessage() . "<br>";
}
?>