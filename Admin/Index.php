<?php
// Admin/index.php

$page = $_GET['page'] ?? 'dashboard';

include __DIR__ . '/View/layouts/Header.php';
include __DIR__ . '/View/layouts/Sidebar.php';
?>

<div class="content">
    <?php
    switch ($page) {
        case 'dashboard':
        default:
            echo '
            <div class="dashboard">
                <h2>Dashboard</h2>
                <div class="cards">
                    <div class="card-box">Users: 120</div>
                    <div class="card-box">Orders: 45</div>
                    <div class="card-box">Revenue: $12,300</div>
                </div>
            </div>';
            break;
    }
    ?>
</div>

<?php include __DIR__ . '/View/layouts/Footer.php'; ?>