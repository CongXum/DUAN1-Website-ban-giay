<?php
// 7. Khởi tạo Model và Controller cho Đơn hàng
$orderModel = new Order($conn);
$orderController = new OrderController($orderModel);

class OrderController {
    private $order;

    public function __construct($orderModel) {
        $this->order = $orderModel;
    }

    // Liệt kê đơn hàng
    public function index() {
        $orders = $this->order->getAll();
        include __DIR__ . '/../View/Modules/Orders/Index.php';
    }

    // Xem chi tiết đơn hàng
    public function view() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $order = $this->order->getOne($id);
            $details = $this->order->getDetailOrder($id);
            include __DIR__ . '/../View/Modules/Orders/View.php';
        } else {
            header("Location: /Admin/index.php?page=orders");
            exit;
        }
    }

    // Cập nhật trạng thái đơn hàng (nếu cần)
    public function updateStatus() {
        $id = $_GET['id'] ?? null;
        $status = $_POST['status'] ?? null;
        if ($id && $status) {
            // Giả sử model có phương thức updateStatus
            $this->order->updateStatus($id, $status);
        }
        header("Location: /Admin/index.php?page=orders");
        exit;
    }
}
?>