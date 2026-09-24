<?php
class TestShoppingCart {
    public static function runTests() {
        try {
            $cart = new ShoppingCart();

            $item1 = new CartItem("Item 1", 10, 2);
            $item2 = new CartItem("Item 2", 5, 3);
            $item3 = new CartItem("Item 3", 20, 1);
            $item4 = new CartItem("Item 4", 15, 4);

            $cart->addItem($item1);
            $cart->addItem($item2);
            $cart->addItem($item3);
            $cart->addItem($item4);

            echo "<h3>Initial Cart</h3>";
            $cart->displayCart();


            $removed = $cart->removeItem("Item 2");
            echo "<h3>" . ($removed ? "Đã xóa Item 2" : "Không tìm thấy Item 2") . "</h3>";
            $cart->displayCart();

            // Test trường hợp xóa item không tồn tại
            $removed2 = $cart->removeItem("Item Không Tồn Tại");
            echo "<h3>" . ($removed2 ? "Đã xóa" : "Không tìm thấy để xóa") . "</h3>";

        } catch (InvalidArgumentException $e) {
            echo "<p style='color:red'>Lỗi dữ liệu đầu vào: " . $e->getMessage() . "</p>";
        }
    }
}
?>