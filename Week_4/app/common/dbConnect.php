<?php
function getDB(): PDO {
    static $pdo = null;   // giữ kết nối, các file khác gọi lại không tạo kết nối mới

    if ($pdo === null) {
        try {
            $pdo = new PDO(
                'mysql:host=localhost;port=3306;dbname=shopping_cart;charset=utf8mb4',
                'root',
                '',
                [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]
            );
        } catch (PDOException $e) {
            // Kết nối thất bại: báo lỗi thân thiện và dừng chương trình
            http_response_code(500);
            die('Không thể kết nối cơ sở dữ liệu. Vui lòng kiểm tra MySQL đã bật chưa và thông tin kết nối.');
            // Khi debug có thể dùng: die('Lỗi kết nối: ' . $e->getMessage());
        }
    }
    return $pdo;
}