<?php
$page = $_GET['page'] ?? 'dashboard';

include __DIR__ . '/View/Layouts/Header.php';
include __DIR__ . '/View/Layouts/Sidebar.php';
?>

<div class="content">

    <?php

    switch ($page) {

        // User management

        case 'users':
            include "View/Modules/Users/Index.php";
            break;

        case 'create-user':
            include "View/Modules/Users/Create.php";
            break;

        case 'update-user':
            include "View/Modules/Users/Update.php";
            break;

        case 'view-user':
            include "View/Modules/Users/View.php";
            break;


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


        default:
            echo "<h2>Dashboard</h2>";
            break;
    }

    ?>

</div>

<?php include __DIR__ . '/View/Layouts/Footer.php'; ?>