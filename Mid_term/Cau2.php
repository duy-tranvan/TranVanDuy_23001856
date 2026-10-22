<?php
$prices = [12, 32, 85, 45, 21, 99];

function calculateTotal($prices) {
    $total = 0;
    foreach ($prices as $price) {
        $total += $price;
    }
    return $total;
}

function findMaxPrice($prices) {
    $max = $prices[0];
    foreach ($prices as $price) {
        if ($price > $max) {
            $max = $price;
        }
    }
    return $max;
}

$total    = calculateTotal($prices);
$maxPrice = findMaxPrice($prices);

echo "Danh sách giá sản phẩm: " . implode(", ", $prices) . "<br>";
echo "Tổng giá trị sản phẩm: " . $total . "<br>";
echo "Giá sản phẩm cao nhất: " . $maxPrice . "<br>";
?>