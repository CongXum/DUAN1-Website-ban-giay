    <?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    session_start();

    require_once __DIR__ . '/../Model/Database.php';
    require_once __DIR__ . '/../Model/Product.php';
    require_once __DIR__ . '/../Model/Category.php';

    


    $db      = new Database();
    $conn    = $db->connect();
    $product = new Product($conn);

    $page = $_GET['page'] ?? 'home';

    include __DIR__ . '/View/Layouts/Header.php';
    ?>

    <div class="main-content">
    <?php
    switch ($page) {
        case 'home':
            include __DIR__ . '/View/Pages/Home.php';
            break;

        case 'product':
            include __DIR__ . '/View/Pages/Product/ProductItems.php';
            break;

        case 'detail':
            include __DIR__ . '/View/Pages/Product/DetailProduct.php';
            break;

        case 'cart':
            include __DIR__ . '/Controller/CartController.php';
            break;

        case 'order':
            include __DIR__ . '/Controller/OrderController.php';
            break;

        case 'orders':
            include __DIR__ . '/View/Pages/Orders.php';
            break;

        case 'checkout':
            include __DIR__ . '/View/Pages/Checkout.php';
            break;

        case 'contact':
            include __DIR__ . '/View/Pages/Contact.php';
            break;

        default:
            include __DIR__ . '/View/Pages/Home.php';
            break;
    }
    ?>
    </div>

    <?php include __DIR__ . '/View/Layouts/Footer.php'; ?>