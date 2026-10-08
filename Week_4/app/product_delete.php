<?php
require_once 'model/product.php';

$id = (int)($_POST['id'] ?? $_GET['id'] ?? 0);
$product = getProductById($id);

if ($product && $_SERVER['REQUEST_METHOD'] === 'POST') {
    deleteProduct($id);
    header('Location: product_list.php');
    exit;
}

include 'view/header.php';
?>
<h2>Xóa sản phẩm</h2>

<?php if (!$product): ?>
    <p class="error">Sản phẩm không tồn tại hoặc đã bị xóa.</p>
    <a href="product_list.php">Quay lại danh sách</a>
<?php else: ?>
    <p>Bạn có chắc muốn xóa sản phẩm
        <strong><?= htmlspecialchars($product['name']) ?></strong> (ID <?= $product['id'] ?>)?</p>
    <form method="post">
        <input type="hidden" name="id" value="<?= $product['id'] ?>">
        <button type="submit">Xác nhận xóa</button>
        <a href="product_list.php">Hủy</a>
    </form>
<?php endif; ?>
<?php include 'view/footer.php'; ?>