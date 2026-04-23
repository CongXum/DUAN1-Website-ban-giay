<?php

class CartController
{
    protected $cartModel;

    private function getUserId()
    {
        if (!isset($_SESSION['user']['id'])) {
            header("Location: index.php?page=login");
            exit;
        }

        return (int) $_SESSION['user']['id'];
    }

    public function __construct($cartModel)
    {
        $this->cartModel = $cartModel;
    }

    // ✅ THÊM GIỎ HÀNG
    public function add()
    {
        $user_id = $this->getUserId();

        $product_id = $_POST['product_id'] ?? $_GET['id'] ?? null;
        $qty = (int)($_POST['qty'] ?? 1);

        if ($product_id) {
            $this->cartModel->addToCart($user_id, $product_id, $qty);
        }

        header("Location: index.php?page=cart");
        exit;
    }

    // ✅ UPDATE GIỎ HÀNG (FIX CHUẨN)
    public function update()
    {
        $user_id = $this->getUserId();

        if (!isset($_POST['qty'])) {
            header("Location: index.php?page=cart");
            exit;
        }

        foreach ($_POST['qty'] as $id => $qty) {
            $qty = (int)$qty;

            if ($qty > 0) {
                $this->cartModel->update($qty, $id, $user_id); // ✅ FIX
            } else {
                $this->cartModel->delete($id, $user_id); // ✅ FIX
            }
        }

        header("Location: index.php?page=cart");
        exit;
    }

    // ✅ HIỂN THỊ GIỎ HÀNG
    public function index()
    {
        $user_id = $this->getUserId();

        if (isset($_GET['delete'])) {
            $this->cartModel->delete((int)$_GET['delete'], $user_id); // ✅ FIX
        }

        $cartItems = $this->cartModel->getAll($user_id);
        $total = $this->cartModel->getTotal($user_id);

        require "Client/View/Pages/Cart.php";
    }

    // ✅ XÓA 1 ITEM
    public function delete()
    {
        $user_id = $this->getUserId();

        if (!isset($_GET['id'])) {
            die('Thiếu id');
        }

        $id = (int)$_GET['id'];

        $this->cartModel->delete($id, $user_id); // ✅ FIX

        header("Location: index.php?page=cart");
        exit;
    }
}