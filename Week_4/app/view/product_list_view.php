<table>
    <tr>
        <th>ID</th><th>Tên</th><th>Giá</th><th>Số lượng</th><th>Thao tác</th>
    </tr>
    <?php if (empty($products)): ?>
        <tr><td colspan="5">Chưa có sản phẩm nào.</td></tr>
    <?php endif; ?>
    <?php foreach ($products as $p): ?>
    <tr>
        <td><?= $p['id'] ?></td>
        <td><?= htmlspecialchars($p['name']) ?></td>
        <td><?= number_format($p['price'], 0, ',', '.') ?> đ</td>
        <td><?= $p['quantity'] ?></td>
        <td>
            <a href="product_edit.php?id=<?= $p['id'] ?>">Sửa</a> |
            <a href="product_delete.php?id=<?= $p['id'] ?>">Xóa</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>