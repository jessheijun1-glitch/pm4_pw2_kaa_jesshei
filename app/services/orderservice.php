<?php

class OrderService
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function createOrder($userId, $items)
    {
        try {
            $this->pdo->beginTransaction();

            $total = 0;

            foreach ($items as $item) {
                $stmt = $this->pdo->prepare(
                    "SELECT id, price, stock
                     FROM products
                     WHERE id = ?
                     FOR UPDATE"
                );

                $stmt->execute([$item['product_id']]);
                $product = $stmt->fetch(PDO::FETCH_ASSOC);

                if (!$product) {
                    throw new Exception("Produk tidak ditemukan.");
                }

                if ($item['quantity'] <= 0) {
                    throw new Exception("Jumlah produk harus lebih dari nol.");
                }

                if ($product['stock'] < $item['quantity']) {
                    throw new Exception("Stok produk tidak mencukupi.");
                }

                $total += $product['price'] * $item['quantity'];
            }

            $stmt = $this->pdo->prepare(
                "INSERT INTO orders (user_id, total, status)
                 VALUES (?, ?, 'pending')"
            );

            $stmt->execute([$userId, $total]);

            $orderId = $this->pdo->lastInsertId();

            foreach ($items as $item) {
                $stmt = $this->pdo->prepare(
                    "SELECT id, price, stock
                     FROM products
                     WHERE id = ?
                     FOR UPDATE"
                );

                $stmt->execute([$item['product_id']]);
                $product = $stmt->fetch(PDO::FETCH_ASSOC);

                $stmt = $this->pdo->prepare(
                    "INSERT INTO order_details
                     (order_id, product_id, quantity, price)
                     VALUES (?, ?, ?, ?)"
                );

                $stmt->execute([
                    $orderId,
                    $product['id'],
                    $item['quantity'],
                    $product['price']
                ]);

                $stmt = $this->pdo->prepare(
                    "UPDATE products
                     SET stock = stock - ?
                     WHERE id = ?"
                );

                $stmt->execute([
                    $item['quantity'],
                    $product['id']
                ]);
            }

            $this->pdo->commit();

            return $orderId;

        } catch (Exception $e) {
            if ($this->pdo->inTransaction()) {
                $this->pdo->rollBack();
            }

            throw $e;
        }
    }
}