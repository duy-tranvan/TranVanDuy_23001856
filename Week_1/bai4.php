<?php
class Student {
    private $name;
    private $age;
    private $score;

    public function __construct($name, $age, $score) {
        $this->name = $name;
        $this->age = $age;
        $this->score = $score;
    }
    public function getName() {
        return $this->name;
    }
    public function getAge() {
        return $this->age;
    }
    public function getScore() {
        return $this->score;
    }
    public function getRank() {
        if ($this->score >= 8) {
            return "Giỏi";
        } elseif ($this->score >= 6.5) {
            return "Khá";
        } elseif ($this->score >= 5) {
            return "Trung bình";
        } else {
            return "Yếu";
        }
    }
    public function isPassed() {
        return $this->score >= 5;
    }
    public function display() {
        echo "Họ tên: " . $this->name . "<br>";
        echo "Tuổi: " . $this->age . "<br>";
        echo "Điểm: " . $this->score . "<br>";
        echo "Xếp loại: " . $this->getRank() . "<br>";
        echo "Kết quả: " . ($this->isPassed() ? "Đậu" : "Rớt") . "<br>";
        echo "<br>";
    }
}

$student1 = new Student("Nguyen Van An", 20, 8.5);
$student2 = new Student("Tran Thi Binh", 21, 6.5);
$student3 = new Student("Le Van Cuong", 19, 4.5);
$student4 = new Student("Pham Thi Dung", 20, 7.5);

$students = [$student1, $student2, $student3, $student4];

echo "<h3>Danh sách sinh viên</h3>";
foreach ($students as $student) {
    $student->display();
}

function findBestStudent($students) {
    $bestStudent = $students[0];
    foreach ($students as $student) {
        if ($student->getScore() > $bestStudent->getScore()) {
            $bestStudent = $student;
        }
    }
    return $bestStudent;
}
function countPassedStudents($students) {
    $count = 0;
    foreach ($students as $student) {
        if ($student->isPassed()) {
            $count++;
        }
    }
    return $count;
}
function calculateAverageScore($students) {
    $sum = 0;
    foreach ($students as $student) {
        $sum += $student->getScore();
    }
    return $sum / count($students);
}

echo "<h3>Sinh viên có điểm cao nhất</h3>";
$bestStudent = findBestStudent($students);
$bestStudent->display();

echo "<h3>Số lượng sinh viên đậu</h3>";
echo countPassedStudents($students);


echo "<h3>Điểm trung bình của lớp</h3>";
echo calculateAverageScore($students);
