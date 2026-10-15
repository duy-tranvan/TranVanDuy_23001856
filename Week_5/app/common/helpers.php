<?php
// Đếm số ký tự (UTF-8), không phụ thuộc extension mbstring
function textLength(string $s): int {
    $n = preg_match_all('/./us', $s);
    return $n === false ? strlen($s) : $n;
}