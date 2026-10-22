<?php
function validatePrices($prices) {
    if (!is_array($prices)) {
        throw new InvalidArgumentException("Dữ liệu đầu vào phải là một mảng.");
    }

    if (count($prices) === 0) {
        throw new LengthException("Danh sách giá không được rỗng.");
    }

    foreach ($prices as $index => $price) {
        if (!is_numeric($price)) {
            throw new InvalidArgumentException("Giá ở vị trí $index không phải là số.");
        }
        if ($price < 0) {
            throw new RangeException("Giá ở vị trí $index không được là số âm.");
        }
    }
}

function calculateTotal($prices) {
    validatePrices($prices);

    $total = 0;
    foreach ($prices as $price) {
        $total += $price;
    }
    return $total;
}

function findMaxPrice($prices) {
    validatePrices($prices);

    $max = reset($prices);
    foreach ($prices as $price) {
        if ($price > $max) {
            $max = $price;
        }
    }
    return $max;
}

$prices = [150000, 320000, 85000, 450000, 210000, 99000];

try {
    $total    = calculateTotal($prices);
    $maxPrice = findMaxPrice($prices);

    echo "Danh sách giá sản phẩm: " . implode(", ", $prices) . "<br>";
    echo "Tổng giá trị sản phẩm: " . number_format($total, 0, ',', '.') . " VNĐ<br>";
    echo "Giá sản phẩm cao nhất: " . number_format($maxPrice, 0, ',', '.') . " VNĐ<br>";
} catch (LengthException $e) {
    echo "Lỗi danh sách: " . $e->getMessage() . "<br>";
} catch (RangeException $e) {
    echo "Lỗi giá trị: " . $e->getMessage() . "<br>";
} catch (InvalidArgumentException $e) {
    echo "Lỗi dữ liệu đầu vào: " . $e->getMessage() . "<br>";
} catch (Exception $e) {
    echo "Đã xảy ra lỗi: " . $e->getMessage() . "<br>";
}
?>