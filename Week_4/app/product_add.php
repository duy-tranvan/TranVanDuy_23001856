<?php
require_once 'model/product.php';

$errors = [];
$product = [];
$title = 'Thêm sản phẩm';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product = $_POST;
    $errors = validateProduct($product);
    if (!$errors) {
        addProduct($product['name'], $product['price'], $product['quantity']);
        header('Location: product_list.php');
        exit;
    }
}

include 'view/header.php';
include 'view/product_form.php';
include 'view/footer.php';