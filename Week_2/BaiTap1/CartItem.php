<?php
class CartItem {
    private $name;
    private $price;
    private $quantity;

    public function __construct($name, $price, $quantity) {
        if (!is_string($name) || trim($name) === '') {
            throw new InvalidArgumentException("Tên sản phẩm không hợp lệ.");
        }
        if (!is_numeric($price) || $price < 0) {
            throw new InvalidArgumentException("Giá phải là số không âm.");
        }
        if (!is_int($quantity) || $quantity <= 0) {
            throw new InvalidArgumentException("Số lượng phải là số nguyên dương.");
        }

        $this->name = $name;
        $this->price = $price;
        $this->quantity = $quantity;
    }

    public function getTotal() {
        return $this->quantity * $this->price;
    }
    public function getName() {
        return $this->name;
    }
    public function getPrice() {
        return $this->price;
    }
    public function getQuantity() {
        return $this->quantity;
    }
}
?>