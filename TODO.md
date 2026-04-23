# Fix lỗi "không chạy được quản lý đơn hàng trong admin"

## Phân tích
- Admin/Index.php thiếu init `$orderModel = new Order($conn); $orderController = new OrderController($orderModel);`
- Orders/Index.php rỗng
- DB remote → user handle connect hoặc thay local config

## Steps
- [ ] Step 1: Edit Admin/Index.php - thêm init Order controller (sau UserController)
- [ ] Step 2: Create/Edit Admin/View/Modules/Orders/Index.php - table hiển thị $orders
- [ ] Step 3: Test `Admin/index.php?page=orders`
- [ ] Done: attempt_completion

Current: Starting Step 1
