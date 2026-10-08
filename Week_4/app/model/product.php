<?php
require_once __DIR__ . '/../common/dbConnect.php';

// Lấy tất cả sản phẩm
function getAllProducts(): array {
    return getDB()->query('SELECT * FROM cart_items ORDER BY id DESC')->fetchAll();
}

// Lấy 1 sản phẩm theo id, không có thì trả về null
function getProductById($id): ?array {
    $stmt = getDB()->prepare('SELECT * FROM cart_items WHERE id = ?');
    $stmt->execute([(int)$id]);
    return $stmt->fetch() ?: null;
}

// Thêm sản phẩm, trả về true nếu thành công
function addProduct($name, $price, $quantity): bool {
    $stmt = getDB()->prepare('INSERT INTO cart_items (name, price, quantity) VALUES (?, ?, ?)');
    return $stmt->execute([trim($name), $price, (int)$quantity]);
}

// Cập nhật sản phẩm, trả về true nếu thành công
function updateProduct($id, $name, $price, $quantity): bool {
    $stmt = getDB()->prepare('UPDATE cart_items SET name = ?, price = ?, quantity = ? WHERE id = ?');
    return $stmt->execute([trim($name), $price, (int)$quantity, (int)$id]);
}

// Xóa sản phẩm, trả về true nếu thành công
function deleteProduct($id): bool {
    $stmt = getDB()->prepare('DELETE FROM cart_items WHERE id = ?');
    return $stmt->execute([(int)$id]);
}

// Hàm phụ (ngoài đề): kiểm tra dữ liệu form
function validateProduct(array $d): array {
    $errors = [];
    if (trim($d['name'] ?? '') === '') {
        $errors[] = 'Tên sản phẩm không được để trống.';
    }
    if (!is_numeric($d['price'] ?? '') || $d['price'] <= 0) {
        $errors[] = 'Giá phải lớn hơn 0.';
    }
    if (!ctype_digit((string)($d['quantity'] ?? ''))) {
        $errors[] = 'Số lượng phải là số nguyên >= 0.';
    }
    return $errors;
}