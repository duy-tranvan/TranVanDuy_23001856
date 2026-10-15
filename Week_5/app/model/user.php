<?php
require_once __DIR__ . '/../common/dbConnect.php';

// Lấy user theo tên đăng nhập, không có thì trả về null
function getUserByUsername($username): ?array {
    $stmt = getDB()->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->execute([$username]);
    return $stmt->fetch() ?: null;
}

// Thêm user mới, mật khẩu được mã hóa bằng password_hash()
// Trả về true nếu thành công, false nếu lỗi (ví dụ trùng tên đăng nhập)
function addUser($username, $password): bool {
    try {
        $stmt = getDB()->prepare('INSERT INTO users (username, password) VALUES (?, ?)');
        return $stmt->execute([$username, password_hash($password, PASSWORD_DEFAULT)]);
    } catch (PDOException $e) {
        return false;
    }
}