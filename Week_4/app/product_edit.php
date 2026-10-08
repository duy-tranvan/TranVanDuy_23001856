<?php
require_once 'model/product.php';

$id = (int)($_GET['id'] ?? $_POST['id'] ?? 0);
$product = getProductById($id);
$errors = [];
$title = 'Sửa sản phẩm';

if (!$product) {
    include 'view/header.php';
    echo '<p class="error">Sản phẩm không tồn tại.</p>';
    echo '<a href="product_list.php">Quay lại danh sách</a>';
    include 'view/footer.php';
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product = array_merge($product, $_POST);   // giữ lại dữ liệu vừa nhập nếu có lỗi
    $errors = validateProduct($product);
    if (!$errors) {
        updateProduct($id, $product['name'], $product['price'], $product['quantity']);
        header('Location: product_list.php');
        exit;
    }
}

include 'view/header.php';
include 'view/product_form.php';
include 'view/footer.php';