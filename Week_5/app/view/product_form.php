<h2><?= htmlspecialchars($title) ?></h2>

<?php foreach ($errors as $e): ?>
    <p class="error"><?= htmlspecialchars($e) ?></p>
<?php endforeach; ?>

<form method="post">
    <label>Tên sản phẩm</label>
    <input type="text" name="name" value="<?= htmlspecialchars($product['name'] ?? '') ?>">

    <label>Giá</label>
    <input type="number" name="price" step="0.01" value="<?= htmlspecialchars($product['price'] ?? '') ?>">

    <label>Số lượng</label>
    <input type="number" name="quantity" min="0" value="<?= htmlspecialchars($product['quantity'] ?? '0') ?>">

    <button type="submit">Lưu</button>
    <a href="product_list.php">Hủy</a>
</form>