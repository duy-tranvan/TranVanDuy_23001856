<?php require_once __DIR__ . '/../common/auth.php'; ?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý sản phẩm</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<div class="container">
    <h1>Quản lý sản phẩm</h1>
    <nav>
        <?php if (isLoggedIn()): ?>
            <a href="product_list.php">Danh sách</a> |
            <a href="product_add.php">Thêm mới</a> |
            Xin chào, <strong><?= htmlspecialchars(currentUsername()) ?></strong> |
            <a href="logout.php">Đăng xuất</a>
        <?php else: ?>
            <a href="login.php">Đăng nhập</a> |
            <a href="register.php">Đăng ký</a>
        <?php endif; ?>
    </nav>
    <hr>