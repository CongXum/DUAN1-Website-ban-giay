<?php

require_once __DIR__ . '/../../Model/Dashboard.php';

class DashboardController
{
    private $model;

    public function __construct($conn)
    {
        $this->model = new DashboardModel($conn);
    }

    public function index()
    {

        $totalUsers = $this->model->totalUsers();
        $totalProducts = $this->model->totalProducts();
        $totalOrders = $this->model->totalOrders();

        $ordersToday = $this->model->ordersToday();
        $revenueToday = $this->model->revenueToday();
        $newUsersToday = $this->model->newUsersToday();
        $outOfStock = $this->model->outOfStock();

        $latestOrders = $this->model->latestOrders();

        $chartData = $this->model->revenue7Days();

        include __DIR__ . '/../View/Modules/Dashboard/Index.php';
    }
}
