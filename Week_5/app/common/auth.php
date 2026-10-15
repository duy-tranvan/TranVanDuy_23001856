<?php
// Khởi động session một lần cho toàn bộ hệ thống
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Đã đăng nhập chưa?
function isLoggedIn(): bool {
    return !empty($_SESSION['user_id']);
}

// Tên tài khoản đang đăng nhập
function currentUsername(): string {
    return $_SESSION['username'] ?? '';
}

// Chặn trang nếu chưa đăng nhập: chuyển về login.php
function requireLogin(): void {
    if (!isLoggedIn()) {
        header('Location: login.php');
        exit;
    }
}