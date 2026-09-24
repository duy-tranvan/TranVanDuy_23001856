<?php
class ShoppingCart {
    private $items = [];

    public function addItem($item) {
        if (!($item instanceof CartItem)) {
            throw new InvalidArgumentException("Chỉ có thể thêm đối tượng CartItem vào giỏ hàng.");
        }
        $this->items[] = $item;
    }

    public function removeItem($name) {
        foreach ($this->items as $key => $item) {
            if ($item->getName() === $name) {
                unset($this->items[$key]);
                $this->items = array_values($this->items); // dồn lại key liên tục
                return true;
            }
        }
        return false; // không tìm thấy để xóa
    }

    public function calculateTotal() {
        $total = 0;
        foreach ($this->items as $item) {
            $total += $item->getTotal();
        }
        return $total;
    }

    public function displayCart() {
        echo "<h3>Shopping Cart</h3>";
        if (empty($this->items)) {
            echo "<p>Giỏ hàng trống.</p>";
            return;
        }
        echo "<table border='1'>";
        echo "<tr><th>Name</th><th>Price</th><th>Quantity</th><th>Total</th></tr>";
        foreach ($this->items as $item) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($item->getName()) . "</td>";
            echo "<td>" . $item->getPrice() . "</td>";
            echo "<td>" . $item->getQuantity() . "</td>";
            echo "<td>" . $item->getTotal() . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "<h4>Total Price: " . $this->calculateTotal() . "</h4>";
    }
}
?>