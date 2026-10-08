<?php
require_once 'model/product.php';
$products = getAllProducts();

include 'view/header.php';
include 'view/product_list_view.php';
include 'view/footer.php';