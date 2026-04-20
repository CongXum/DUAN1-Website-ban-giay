<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$page = $_GET['page'] ?? 'dashboard';

// 3. Khởi tạo kết nối Database
// $db = new Database();
// $conn = $db->connect();

// 6. Giao diện Header & Sidebar
include __DIR__ . '/View/layouts/Header.php';
include __DIR__ . '/View/layouts/Sidebar.php';
?>

<div class="content">

<?php
switch($page){
        // Product management
        case "products":
            include "View/Modules/Products/Index.php";
            break;

        case "create-product":
            include "View/Modules/Products/Create.php";
            break;

        case "update-product":
            include "View/Modules/Products/Update.php";
            break;

        case "view-product":
            include "View/Modules/Products/View.php";
            break;

        // User management
        case "users":
            include "View/Modules/Users/Index.php";
            break;

        // Categories management

        case "categories":
            include "View/Modules/Categories/Index.php";
            break;

        // Orders management

        case "orders":
            include "View/Modules/Orders/Index.php";
            break;
        case "view-order":
            include "View/Modules/Orders/View.php";
            break;
        case "edit-order":
            include "View/Modules/Orders/Edit.php";
            break;

        // Blogs management

        case "blogs":
            include "View/Modules/Blogs/Index.php";
            break;

        // Comments management

        case "comments":
            include "View/Modules/Comment/Index.php";
            break;

        // Settings
        case "settings":
            include "View/Modules/Settings/Index.php";
            break;

        default:
            include "View/Modules/Dashboard/Index.php";
            break;
    }

    ?>

</div>

<?php include __DIR__ . '/View/Layouts/Footer.php'; ?>