    <?php
    session_start();
    ob_start(); // ✅ fix lỗi header

    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    

    require_once __DIR__ . '/Model/Database.php';
    require_once __DIR__ . '/Model/Product.php';
    require_once __DIR__ . '/Model/User.php';
    require_once __DIR__ . '/Model/Cart.php';
    require_once __DIR__ . '/Model/Order.php';

    require_once __DIR__ . '/Client/Controller/CartController.php';
    require_once __DIR__ . '/Client/Controller/OrderController.php';

    $db = new Database();
    $conn = $db->connect();

    $product = new Product($conn);
    $userModel = new User($conn);
    $orderModel = new Order($conn);
    $cartModel = new Cart($conn);

    $orderController = new OrderController($orderModel, $cartModel);

    $page = isset($_GET['page']) ? strtolower(trim($_GET['page'])) : 'home';

    // ============================
    // ✅ XỬ LÝ LOGIC TRƯỚC (QUAN TRỌNG)
    // ============================
    switch ($page) {

        case 'place-order':
            $orderController->placeOrder();
            exit;

        case 'cancel-order':
            $orderController->cancel();
            exit;

        case 'mark-paid':
            $orderController->markPaid();
            exit;

        case 'update-cart':
            $cartController = new CartController($cartModel);
            $cartController->update();
            exit;

        case 'add-cart':
            $cartController = new CartController($cartModel);
            $cartController->add();
            exit;

        case 'delete-cart':
            $cartController = new CartController($cartModel);
            $cartController->delete();
            exit;
    }


    // ============================
    // ✅ LOAD HEADER
    // ============================
    include __DIR__ . '/Client/View/Layouts/Header.php';


    // ============================
    // ✅ HIỂN THỊ GIAO DIỆN
    // ============================
    switch ($page) {

        case 'home':
            require_once 'Client/Controller/HomeController.php';
            $home = new HomeController($conn); // ✅ FIX
            $home->index();
            break;

        case 'login':
            include __DIR__ . '/Client/View/Pages/Login.php';
            break;

        case 'register':
            include __DIR__ . '/Client/View/Pages/Register.php';
            break;

        case 'logout':
            session_destroy();
            header("Location: index.php");
            exit;

        case 'detail':
            include __DIR__ . '/Client/View/Pages/Product/DetailProduct.php';
            break;

        case 'cart':
            $cartController = new CartController($cartModel);
            $cartController->index();
            break;

        case 'checkout':
            include 'Client/View/Pages/Checkout.php';
            break;

        case 'order-detail':
            include 'Client/View/Pages/OrderDetail.php';
            break;

        case 'vietqr':
            $order_id = $_GET['order_id'] ?? 0;
            $order = $orderModel->getOne($order_id);

            if (!$order) {
                echo "Đơn hàng không tồn tại";
                exit;
            }

            $bank = "970422";
            $account = "0396928846";
            $amount = $order['total'];
            $content = "ORDER" . $order_id;

            $qr_url = "https://img.vietqr.io/image/{$bank}-{$account}-compact2.png?amount={$amount}&addInfo={$content}";

            require_once 'Client/View/Pages/vietqr.php';
            break;

        case 'contact':

            include __DIR__ . '/Client/View/Pages/Contact.php';
            break;
        case 'product':

        case 'product-items':
            // Gọi hàm getAll() từ class Product để lấy danh sách giày
            $dssp = $product->getAll();
            include __DIR__ . '/Client/View/Pages/Product/ProductItems.php';
            break;

        case 'detail':

        case 'product-detail':
            // Lấy ID từ URL (ví dụ: index.php?page=detail&id=5)
            $id = isset($_GET['id']) ? $_GET['id'] : 0;
            $sp_detail = $product->getOne($id);
            include __DIR__ . '/Client/View/Pages/Product/DetailProduct.php';
            break;
        case 'order':
            $ordersModel = $orderModel; // 👈 thêm dòng này
            include __DIR__ . '/Client/View/Pages/Orders.php';
            break;
        case 'success':
            include 'Client/View/Pages/success.php';
            break;

        default:
            require_once 'Client/Controller/HomeController.php';
            $home = new HomeController($conn);
            $home->index();
            break;
    }


    // ============================
    // ✅ FOOTER
    // ============================
    include __DIR__ . '/Client/View/Layouts/Footer.php';

    ob_end_flush();
