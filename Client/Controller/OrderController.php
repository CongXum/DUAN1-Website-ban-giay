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


        // Lấy giỏ hàng
        $cartItems = $this->cartModel->getAll($user_id);


        if (empty($cartItems)) {
            header("Location: index.php?page=cart");
            exit;
        }

        // Tính tổng tiền
        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item['qty'] * $item['price'];
        }

        // 1. Tạo order
        $order_id = $this->orderModel->createOrder(
            $user_id,
            $name,
            $email,
            $phone,
            $address,
            $total,
            $payment_method
        );

        // 2. Lưu chi tiết đơn
        foreach ($cartItems as $item) {
            $this->orderModel->insertOrderDetail(
                $order_id,
                $item['product_id'],
                $item['qty'],
                $item['price']
            );
        }



        // 3. Redirect theo phương thức thanh toán
        if ($payment_method === 'vietqr') {
            header("Location: index.php?page=vietqr&order_id=" . $order_id);
            exit;
        }

        // mặc định (COD,...)
        header("Location: index.php?page=order-detail&id=" . $order_id);
        exit;
    }

    public function markPaid()
    {
        $order_id = $_GET['order_id'] ?? 0;

        $this->orderModel->updateStatus($order_id, 'paid');

        echo json_encode(['status' => 'ok']);
    }
}
