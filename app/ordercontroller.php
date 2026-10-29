<?php

require_once __DIR__ . '/../services/OrderService.php';

class OrderController
{
    private $orderService;

    public function __construct($pdo)
    {
        $this->orderService = new OrderService($pdo);
    }

    public function create()
    {
        echo "Order Controller berhasil dijalankan.";
    }
}