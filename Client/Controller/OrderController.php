<?php

class OrderController
{
    protected $orderModel;
    protected $cartModel;

    public function __construct($orderModel, $cartModel)
    {
        $this->orderModel = $orderModel;
        $this->cartModel = $cartModel;
    }

    public function placeOrder()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: index.php?page=checkout");
            exit;
        }

        $user_id = $_SESSION['user']['id'] ?? 0;

        if ($user_id == 0) {
            header("Location: index.php?page=login");
            exit;
        }

        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $phone = trim($_POST['phone']);
        $address = trim($_POST['address']);
        $payment_method = $_POST['payment_method'] ?? 'cod';

        $cartItems = $this->cartModel->getAll($user_id);

        if (empty($cartItems)) {
            header("Location: index.php?page=cart");
            exit;
        }

        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item['qty'] * $item['price'];
        }

        $order_id = $this->orderModel->createOrder(
            $user_id,
            $name,
            $email,
            $phone,
            $address,
            $total,
            $payment_method
        );

        foreach ($cartItems as $item) {
            $this->orderModel->insertOrderDetail(
                $order_id,
                $item['product_id'],
                $item['qty'],
                $item['price']
            );
        }

        $this->cartModel->clearCart($user_id);

        if ($payment_method === 'vietqr') {
            header("Location: index.php?page=vietqr&order_id=" . $order_id);
            exit;
        }

        header("Location: index.php?page=order-detail&id=" . $order_id);
        exit;
    }

    public function cancel()
    {
        $id = $_GET['id'] ?? 0;
        $user_id = $_SESSION['user']['id'] ?? 0;

        if ($user_id == 0) {
            header("Location: index.php?page=login");
            exit;
        }

        $order = $this->orderModel->getOne($id);

        if (!$order) {
            die("Đơn không tồn tại");
        }

        if ($order['user_id'] != $user_id) {
            die("Không có quyền");
        }

        if ($order['status'] != 'pending') {
            die("Không thể hủy");
        }

        $this->orderModel->updateStatus($id, 'cancelled');

        header("Location: index.php?page=orders");
        exit;
    }

    public function markPaid()
    {
        $order_id = $_GET['order_id'] ?? 0;
        $this->orderModel->updateStatus($order_id, 'paid');
        echo json_encode(['status' => 'ok']);
    }
}