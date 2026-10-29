<?php

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/Product.php';

class ProductController
{
    public function index()
    {
        global $pdo;

        $product = new Product($pdo);

        $products = $product->all();

        require __DIR__ . '/../../views/pages/products/index.php';
    }
}