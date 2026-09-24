<?php
require_once 'Movie.php';
require_once 'MovieUtils.php';

function testCase($label, callable $action) {
    echo "<h4>Test: " . htmlspecialchars($label) . "</h4>";
    try {
        $action();
        echo "<p style='color:green'>OK - không có lỗi.</p>";
    } catch (InvalidArgumentException $e) {
        echo "<p style='color:red'>Lỗi dữ liệu đầu vào: " . htmlspecialchars($e->getMessage()) . "</p>";
    } catch (RuntimeException $e) {
        echo "<p style='color:red'>Lỗi xử lý: " . htmlspecialchars($e->getMessage()) . "</p>";
    }
}

try {
    // --- Kịch bản chính ---
    $movies = [
        new Movie(1, "Avengers", 100000, 100),
        new Movie(2, "Avatar", 120000, 80),
        new Movie(3, "Batman", 90000, 120),
    ];

    $avengers = findMovieById($movies, 1);
    $avengers->bookTicket(30);

    $avatar = findMovieById($movies, 2);
    $avatar->bookTicket(50);

    $avengers->cancelTicket(10);

    echo "<h3>Danh sách phim</h3>";
    echo "<table border='1' cellpadding='6'>";
    echo "<tr><th>ID</th><th>Tên phim</th><th>Giá vé</th><th>Tổng ghế</th><th>Ghế còn lại</th><th>Vé đã bán</th><th>Doanh thu</th></tr>";
    foreach ($movies as $movie) {
        $movie->displayInfo();
    }
    echo "</table>";

    echo "<h3>Tổng doanh thu: " . number_format(getTotalRevenue($movies)) . " VND</h3>";

    $bestMovie = getBestSellingMovie($movies);
    echo "<h3>Phim bán chạy nhất: " . htmlspecialchars($bestMovie->getTitle())
       . " (" . $bestMovie->getSoldSeats() . " vé)</h3>";

} catch (Exception $e) {
    echo "<p style='color:red'>Lỗi: " . htmlspecialchars($e->getMessage()) . "</p>";
}

echo "<hr><h2>Các test case ngoại lệ</h2>";

// 1. Đặt vé với số lượng âm
testCase("Đặt vé số lượng âm (-5)", function () use ($movies) {
    $movies[0]->bookTicket(-5);
});

// 2. Đặt vé với số lượng = 0
testCase("Đặt vé số lượng = 0", function () use ($movies) {
    $movies[0]->bookTicket(0);
});

// 3. Đặt vé vượt quá số ghế còn lại
testCase("Đặt vé vượt quá ghế trống (Batman: đặt 200/120)", function () use ($movies) {
    $movies[2]->bookTicket(200);
});

// 4. Hủy vé với số lượng âm
testCase("Hủy vé số lượng âm (-3)", function () use ($movies) {
    $movies[0]->cancelTicket(-3);
});

// 5. Hủy vé nhiều hơn số đã bán (Batman chưa bán vé nào)
testCase("Hủy vé vượt quá số đã bán (Batman: hủy 1 vé nhưng đã bán 0)", function () use ($movies) {
    $movies[2]->cancelTicket(1);
});

// 6. Tạo Movie với giá âm
testCase("Tạo Movie với giá vé âm", function () {
    new Movie(4, "Test Movie", -50000, 100);
});

// 7. Tạo Movie với tổng số ghế = 0
testCase("Tạo Movie với tổng số ghế = 0", function () {
    new Movie(5, "Test Movie 2", 100000, 0);
});

// 8. Tạo Movie với tổng số ghế không phải số nguyên
testCase("Tạo Movie với tổng số ghế không phải số nguyên (50.5)", function () {
    new Movie(6, "Test Movie 3", 100000, 50.5);
});

// 9. Tìm phim với ID không tồn tại
testCase("Tìm phim với ID không tồn tại (999)", function () use ($movies) {
    $result = findMovieById($movies, 999);
    if ($result === null) {
        echo "<p>findMovieById trả về null như mong đợi.</p>";
    } else {
        throw new RuntimeException("Lẽ ra phải trả về null!");
    }
});
?>