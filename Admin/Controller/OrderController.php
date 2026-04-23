<?php
require_once __DIR__ . '/../../Model/Order.php';

class OrderController
{
    protected $orderModel;

    public function __construct($conn)
    {
        $this->orderModel = new Order($conn);
    }

    // 📋 Danh sách + phân trang + filter
    public function index()
    {
        $keyword = $_GET['keyword'] ?? '';
        $status  = $_GET['status'] ?? '';
        $page    = $_GET['p'] ?? 1;
        $limit   = 5;

        // ép kiểu an toàn
        $page = max(1, (int)$page);
        $offset = ($page - 1) * $limit;

        // 👉 Lấy dữ liệu
        $orders = $this->orderModel->getAllAdmin($keyword, $status, $page, $limit);

        // 👉 Tổng số đơn
        $totalOrders = $this->orderModel->countAllAdmin($keyword, $status);
        $totalPages  = ceil($totalOrders / $limit);

        require_once __DIR__ . '/../View/Modules/Orders/Index.php';
    }

    // 🔄 Cập nhật trạng thái
    public function updateStatus()
    {
        $id     = $_GET['id'] ?? 0;
        $status = $_GET['status'] ?? 'pending';

        if ($id > 0) {
            $this->orderModel->updateStatus($id, $status);
        }

        header("Location: admin?page=orders");
        exit;
    }

    // 🔍 Chi tiết đơn hàng
    public function detail()
    {
        $id = $_GET['id'] ?? 0;

        if ($id <= 0) {
            echo "Đơn hàng không tồn tại";
            return;
        }

        $order = $this->orderModel->getOne($id);
        $orderItems = $this->orderModel->getDetailOrder($id);

        require_once __DIR__ . '/../View/Modules/Orders/View.php';
    }
}
